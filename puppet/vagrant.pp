$envs = ['development']

$runner_name  = 'vagrant'
$runner_group = 'vagrant'
$runner_home  = '/home/vagrant'
$runner_path  = '/usr/local/sbin:/usr/local/bin:/usr/bin:/bin'

$app_name       = 'wordpress'
$app_home       = '/vagrant'

class { '::mcommons': }

class { '::mcommons::mysql':
  db_password      => '',
  db_root_password => '',
  daily_backup     => false,
  php_enable       => true,
}

class { '::mcommons::apache':
  force_ssl => true,
  port      => 8000, # set forwarded_port in Vagrantfile
  ssl_port  => 4430, # set forwarded_port in Vagrantfile
  snakeoil  => true,
  php       => true,
  opcache   => 'Off',
}
