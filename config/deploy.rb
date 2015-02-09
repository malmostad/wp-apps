# The Capistrano 2 tasks will use your **working copy**
# Execute one of the following to deploy into staging or production:
#   $ bundle exec cap [one of the :stages] deploy
# Rollback one step:
#   $ bundle exec cap [one of the :stages] deploy:rollback

require 'capistrano/ext/multistage'
require 'fileutils'

server server_address, :web
set :use_sudo, false

# We use stages to specify both the actual stage and the service to deploy
set :stages,
    %w(external-blog-staging internal-blog-staging internal-news-staging
       external-blog-production internal-blog-production internal-news-production)

set :themes_dir, 'wp-content/themes'

# Using your local copy, update the stuff you want to deploy
set :deploy_via, :copy
set :copy_exclude, [
  '**/.sass-cache', '**/.git*', '**/.DS_Store',
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
    run_locally "cd #{themes_dir} && tar -jcf themes.tar.bz2 master #{wp_app}"
    top.upload "#{themes_dir}/themes.tar.bz2", "#{releases_path}", via: :scp
    run "cd #{releases_path} &&
         tar -jxf themes.tar.bz2 && rm themes.tar.bz2 &&
         mkdir #{release_name} &&
         mv master #{release_name}/ &&
         mv #{wp_app} #{release_name}/"
  end

  task :continue do
    if stage.nil? || !stages.include?(stage)
      puts "\033[1;31mYou must specify the wp_app + stage in your command, e.g.:\033[0m"
      puts "  \033[0;32m$ bundle exec cap internal-blog-staging deploy\033[0m"
      puts "  \033[0;32m$ Available stages are:\033[0m"
      puts "  \033[0;32m$ #{stages.join(" | ")}\033[0m"
      Kernel.exit(1)
    end
    puts ''
    puts "wp_app + stage:    \033[0;32m#{stage}\033[0m"
    puts ''
    puts "This will use your \033[0;32mworking copy\033[0m, compile the assets and deploy them to:"
    puts "  \033[0;32m#{server_address} #{releases_path}/#{release_name}\033[0m"
    puts ''
    continue = Capistrano::CLI.ui.ask 'Do you want to continue [y/n]: '
    Kernel.exit(1) if continue.downcase != 'y' && continue.downcase != 'yes'
  end
end

namespace :build do
  desc 'Precompile assets locally'
  task :default do
    run_locally("cd #{themes_dir}")
    run_locally("
      sass --style compressed  #{wp_app}/stylesheets/application.scss
      > #{wp_app}/stylesheets/application.css")
  end

  desc 'CLeanup build files'
  task :cleanup do
    run_locally("cp #{themes_dir} && rm themes.tar.bz2")
  end
end
