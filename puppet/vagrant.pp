$envs = ['development']

$runner_name  = 'vagrant'
$runner_group = 'vagrant'
$runner_home  = '/home/vagrant'
$runner_path  = '/usr/local/sbin:/usr/local/bin:/usr/bin:/bin'

$app_name = 'wordpress'
$app_home = '/vagrant'
$doc_root = "${::runner_home}/wordpress"

class { '::mcommons': }

-> class { '::mcommons::mysql':
  db_password      => '',
  db_root_password => '',
  daily_backup     => false,
  php_enable       => true,
}

-> class { '::mcommons::apache':
  port      => 8000,
  ssl_port  => 4430,
  ssl       => true,
  force_ssl => true,
  php       => true,
  opcache   => 'On',
  snakeoil  => true,
}

-> class { '::mcommons::wordpress':
  table_prefix => '',
}

-> class { '::mcommons::wordpress::vagrant':
  capistrano_tasks => ['local:update_plugins'],
}
