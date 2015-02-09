# The Capistrano 2 tasks will use your **working copy**
# Execute one of the following to deploy into staging or production:
#   $ bundle exec cap [one of the :stages] deploy
# Rollback one step:
#   $ bundle exec cap [one of the :stages] deploy:rollback

# We use stages to specify both the actual stage and the service to deploy
# set :stages, %w(staging production)
# set :default_stage, 'staging'
# set :stage_dir, 'config/deploy'

require 'bundler/capistrano'
require 'capistrano/ext/multistage'
require 'fileutils'

set :use_sudo, false
set :themes_dir, 'wp-content/themes'

# Using your local copy, update the stuff you want to deploy
set :deploy_via, :copy
set :copy_exclude, [
  '**/.sass-cache', '**/.git*', '**/.DS_Store', '**/._.DS_Store',
  '**/*.scss', '**/*.css.map',
  '.gitignore', '.bowerrc', 'package.json'
]

default_run_options[:pty] = true
ssh_options[:forward_agent] = true

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
    run "
cd #{releases_path} && \
tar -jxf themes.tar.bz2 && \
mkdir #{release_name} && \
mv master #{release_name}/ && \
mv #{theme} #{release_name}/"
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
