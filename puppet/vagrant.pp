$envs = ['development']

$runner_name  = 'vagrant'
$runner_group = 'vagrant'
$runner_home  = '/home/vagrant'
$runner_path  = '/usr/local/sbin:/usr/local/bin:/usr/bin:/bin'

$app_name = 'wordpress'
$app_home = '/vagrant'
$doc_root  = "${::runner_home}/wordpress"

class { '::mcommons': }

class { '::mcommons::mysql':
  db_password      => '',
  db_root_password => '',
  daily_backup     => false,
  php_enable       => true,
}

class { '::mcommons::apache':
  ssl       => false,
  force_ssl => false,
  php       => true,
  opcache   => 'Off',
}

class { '::mcommons::wordpress': }
