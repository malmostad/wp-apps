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
}

class { '::mcommons::apache':
  force_ssl      => true,
  php            => true,
  snakeoil_certs => true,
}
