VAGRANTFILE_API_VERSION = '2'

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  # One box for each service. Corresponds to the child theme names.
  # Append the name at the end of vagrant commands, e.g.
  #  vagrant up internal_news
  #  vagrant ssh internal_news
  config.vm.define :internal_news
  config.vm.define :internal_blog
  config.vm.define :external_blog

  config.vm.box = 'ubuntu/trusty64'
  config.vm.hostname = 'www.local.malmo.se'

  config.vm.provider :virtualbox do |v|
    v.memory = 1024
    v.cpus = 2
  end
  config.vm.provider :vmware_fusion
  config.vm.provider :vmware_workstation

  config.vm.network 'forwarded_port', guest: 80, host: 8000
  # config.vm.network 'forwarded_port', guest: 443, host: 4430

  # Setup Puppet environment and install malmo-mcommons using bash script
  config.vm.provision :shell, path: 'https://raw.githubusercontent.com/malmostad/puppet-mcommons/master/bootstrap.sh'

  # Run vagrant.pp Puppet install and configuration
  config.vm.provision :puppet do |puppet|
    puppet.manifests_path = 'puppet'
    puppet.manifest_file = 'vagrant.pp'
    puppet.module_path = 'puppet'
    puppet.facter = {
      'fqdn' => 'www.local.malmo.se'
    }
  end
end
