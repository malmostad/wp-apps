set :server_address, 'webapps07.malmo.se'
server server_address, :web
set :theme, 'external-blog'
set :deploy_to, "~/linked-wp-apps/#{theme}-theme/production"
