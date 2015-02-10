set :server_address, 'webapps07.malmo.se'
server server_address, :web
set :theme, 'external-blog'
set :deploy_to, "/home/marten/#{theme}-theme/staging"
