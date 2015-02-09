set :server_address, 'webapps04.malmo.se'
server server_address, :web
set :theme, 'internal-news'
set :deploy_to, "/srv/www/#{theme}-theme/production"
