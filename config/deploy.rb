# The Capistrano 2 tasks will use your **working copy**
# Execute one of the following to deploy into staging or production:
#   $ bundle exec cap [one of the :stages] deploy
# Rollback one step:
#   $ bundle exec cap [one of the :stages] deploy:rollback

require 'bundler/capistrano'
require 'capistrano/ext/multistage'
require 'fileutils'

set :remote_plugins, [
  'akismet.3.1.1.zip',
  'auto-hyperlink-urls.4.0.zip',
  'content-scheduler.2.0.5.zip',
  'valideratext.2.0.zip',
  'wpdirauth.1.7.6.zip'
]

set :custom_plugins, [
  'force-login',
  'force-ssl-in-content',
  'portwise-authentication'
]

set :use_sudo, false
set :deploy_to, '/home/app_runner/wordpress-custom'
set :themes_dir, "#{releases_path}/#{release_name}/themes"
set :plugins_dir, "#{releases_path}/#{release_name}/plugins"

# Using your local copy, update the stuff you want to deploy first
set :deploy_via, :copy
set :copy_exclude, [
  '**/.sass-cache', '**/.DS_Store', '**/._.DS_Store',
  '**/*.scss', '**/*.css.map',
  '**/*.coffee'
]
set :tar_excludes, copy_exclude.map { |e| "--exclude #{e}" }.join(' ')

default_run_options[:pty] = true
ssh_options[:forward_agent] = true

set(:user) do
  Capistrano::CLI.ui.ask "Username for #{server_address}: "
end

before 'deploy', 'deploy:continue', 'build'
after 'deploy', 'deploy:create_symlink'

namespace :deploy do
  desc 'Deploy themes, custom plugins and remote plugins on server'
  task :default do

    # Deploy themes to server
    run_locally "cd themes && tar -jcf themes.tar.bz2 #{tar_excludes} master #{theme}"
    run "mkdir -p #{themes_dir}"
    top.upload 'themes/themes.tar.bz2', themes_dir, via: :scp
    run "cd #{themes_dir} && tar -jxf themes.tar.bz2 && rm themes.tar.bz2"
    run_locally 'rm themes/themes.tar.bz2'

    # Deploy custom Wordpress plugins to server
    run_locally "cd plugins && tar -jcf plugins.tar.bz2 #{tar_excludes} #{custom_plugins.join(' ')}"
    run "mkdir -p #{plugins_dir}"
    top.upload 'plugins/plugins.tar.bz2', plugins_dir, via: :scp
    run "cd #{plugins_dir} && tar -jxf plugins.tar.bz2 && rm plugins.tar.bz2"
    run_locally 'rm plugins/plugins.tar.bz2'

    # Install plugins from wordpress.org to server
    remote_plugins.each do |plugin|
      run "wget https://downloads.wordpress.org/plugin/#{plugin} -O #{plugins_dir}/#{plugin}"
      run "cd #{plugins_dir} && unzip -o #{plugin}"
      run "rm #{plugins_dir}/#{plugin}"
    end
  end

  task :continue do
    puts ''
    puts 'Theme:'
    puts "  \033[0;32mmaster and #{theme}\033[0m"
    puts 'Remote plugins:'
    puts "  \033[0;32m#{remote_plugins.join(', ')}\033[0m"
    puts 'Custom plugins:'
    puts "  \033[0;32m#{custom_plugins.join(', ')}\033[0m"
    puts "This will use the themes in your \033[0;32mworking copy\033[0m, compile the assets and deploy the theme to:"
    puts "  \033[0;32m#{server_address} #{releases_path}/#{release_name}\033[0m"
    puts ''
    continue = Capistrano::CLI.ui.ask 'Do you want to continue [y/n]: '
    Kernel.exit(1) if continue.downcase != 'y' && continue.downcase != 'yes'
  end
end

namespace :build do
  desc 'Precompile assets locally'
  task :default do
    run_locally("cd themes && \
      sass --style compressed #{theme}/stylesheets/application.scss > #{theme}/stylesheets/application.css")
  end
end

# $ cap vagrant install_remote_plugins
desc 'Install plugins from wordpress.org on Vagrant'
task :install_remote_plugins do
  Dir.chdir(plugins_dir) do
    remote_plugins.each do |plugin|
      run_locally "wget https://downloads.wordpress.org/plugin/#{plugin} -O #{plugin}"
      run_locally "unzip -o #{plugin}"
      run_locally "rm #{plugin}"
    end
  end
end
