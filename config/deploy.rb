# The Capistrano 2 tasks will use your **working copy**
# Execute one of the following to deploy into staging or production:
#   $ bundle exec cap [one of the :stages] deploy
# Rollback one step:
#   $ bundle exec cap [one of the :stages] deploy:rollback

require 'bundler/capistrano'
require 'capistrano/ext/multistage'
require 'fileutils'

set :thirdparty_wp_plugins, [
  'akismet.3.1.1.zip',
  'auto-hyperlink-urls.4.0.zip',
  'content-scheduler.2.0.5.zip',
  'valideratext.2.0.zip',
  'wpdirauth.1.7.6.zip'
]

set :custom_wp_plugins, [
  'force-login',
  'force-ssl-in-content',
  'portwise-authentication'
]

set :use_sudo, false
set :themes_dir, 'themes'
set :deploy_to, '/home/app_runner/wordpress-custom'
set :plugins_dir, "#{releases_path}/#{release_name}/plugins"

# Using your local copy, update the stuff you want to deploy
set :deploy_via, :copy
set :copy_exclude, [
  '**/.sass-cache', '**/.git*', '**/.DS_Store', '**/._.DS_Store',
  '**/*.scss', '**/*.css.map',
  '.gitignore', '.bowerrc', 'package.json'
]

default_run_options[:pty] = true
ssh_options[:forward_agent] = true

set :cdr, "cd #{releases_path} &&"
set :cdrp, "cd #{releases_path}/plugins &&"

set(:user) do
  Capistrano::CLI.ui.ask "Username for #{server_address}: "
end

before 'deploy', 'deploy:continue', 'build'
after 'deploy', 'deploy:create_symlink', 'build:cleanup'

namespace :deploy do
  desc 'Deploy themes to server'
  task :default do
    run_locally "cd #{themes_dir} && tar -jcf themes.tar.bz2 --exclude=#{copy_exclude.join(' --exclude=')} master #{theme}"
    top.upload "#{themes_dir}/themes.tar.bz2", "#{releases_path}", via: :scp
    custom_wp_plugins.map! { |p| "plugins/#{p}" }
    run_locally "tar -jcf plugins.tar.bz2 #{custom_wp_plugins.join(' ')}"
    run "#{cdr} tar -jxf themes.tar.bz2"
    run "#{cdr} mkdir #{release_name}"
    run "#{cdr} mv master #{release_name}/"
    run "#{cdr} mv #{theme} #{release_name}/"
  end

  desc 'Deploy custom Wordpress plugins to server'
  task :custom_wp_plugins do
    run "mkdir #{releases_path}/plugins"
    custom_wp_plugins.map! { |p| "plugins/#{p}" }
    run_locally "tar -jcf plugins.tar.bz2 #{custom_wp_plugins.join(' ')}"
    run "#{cdr} tar -jxf plugins.tar.bz2"
    run "#{cdr} mkdir #{release_name}"
    run "#{cdr} mv master #{release_name}/"
    run "#{cdr} mv #{theme} #{release_name}/"
  end

  desc 'Install plugins from wordpress.org'
  task :install_wp_plugins do
    thirdparty_wp_plugins.each do |plugin|
      run "#{cdrp} wget https://downloads.wordpress.org/plugin/#{plugin} -O #{plugin}"
      run "#{cdrp} unzip -o #{plugin}"
      run "#{cdrp} rm #{plugin}"
    end
  end

  task :continue do
    puts ''
    puts 'Theme:'
    puts "  \033[0;32mmaster and #{theme}\033[0m"
    puts "This will use your \033[0;32mworking copy\033[0m, compile the assets and deploy the theme to:"
    puts "  \033[0;32m#{server_address} #{releases_path}/#{release_name}\033[0m"
    puts ''
    continue = Capistrano::CLI.ui.ask 'Do you want to continue [y/n]: '
    Kernel.exit(1) if continue.downcase != 'y' && continue.downcase != 'yes'
  end
end

namespace :build do
  desc 'Precompile assets locally'
  task :default do
    run_locally("cd #{themes_dir} && \
      sass --style compressed #{theme}/stylesheets/application.scss > #{theme}/stylesheets/application.css")
  end

  desc 'CLeanup build files'
  task :cleanup do
    run_locally "cd #{themes_dir} && rm themes.tar.bz2"
    run "cd #{releases_path} && rm themes.tar.bz2"
  end
end

# To install plugins locally in Vagrant:
# $ cap local install_plugins
desc 'Install plugins from wordpress.org'
task :install_plugins do
  Dir.chdir(plugins_dir) do
    thirdparty_wp_plugins.each do |plugin|
      run_locally "wget https://downloads.wordpress.org/plugin/#{plugin} -O #{plugin}"
      run_locally "unzip -o #{plugin}"
      run_locally "rm #{plugin}"
    end
  end
end
