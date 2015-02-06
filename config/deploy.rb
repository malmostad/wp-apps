# config valid only for current version of Capistrano
lock '3.3.5'

set :application, 'wp-apps'
set :repo_url, 'git@github.com:malmostad/wp-apps.git'

# Default branch is :master
# ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }.call

# Default deploy_to directory is /var/www/my_app_name
set :deploy_to, '/var/www/wp-apps/news'


desc "Are you sure?"
task :are_you_sure do
  on roles(:app) do |server|
    puts ""
    puts "Service:      \033[0;32m#{fetch(:service)}\033[0m"
    puts "Environment:   \033[0;32m#{fetch(:env)}\033[0m"
    puts "Server:        \033[0;32m#{server.hostname}\033[0m"
    puts ""
    puts "Do you want to deploy?"
    set :continue, ask("[y/n]:", "n")
    if fetch(:continue).downcase != 'y' && fetch(:continue).downcase != 'yes'
      puts "Deployment stopped"
      exit
    else
      puts "Deployment starting"
    end
  end
end

before :starting, "deploy:are_you_sure", "deploy:check_revision"




# Default value for :scm is :git
# set :scm, :git

# Default value for :format is :pretty
# set :format, :pretty

# Default value for :log_level is :debug
# set :log_level, :debug

# Default value for :pty is false
# set :pty, true

# Default value for :linked_files is []
# set :linked_files, fetch(:linked_files, []).push('config/database.yml')

# Default value for linked_dirs is []
# set :linked_dirs, fetch(:linked_dirs, []).push('bin', 'log', 'tmp/pids', 'tmp/cache', 'tmp/sockets', 'vendor/bundle', 'public/system')

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
# set :keep_releases, 5

namespace :deploy do

  # after :restart, :clear_cache do
  #   on roles(:web), in: :groups, limit: 3, wait: 10 do
  #     # Here we can do anything such as:
  #     # within release_path do
  #     #   execute :rake, 'cache:clear'
  #     # end
  #   end
  # end

end
