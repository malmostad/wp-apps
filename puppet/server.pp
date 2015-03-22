$envs = ['production']

$runner_name  = 'app_runner'
$runner_group = 'app_runner'
$runner_home  = '/home/app_runner'
$runner_path  = "/usr/local/sbin:/usr/local/bin:/usr/bin:/bin"

$app_name       = 'wordpress'
$app_home       = "${::runner_home}/${::app_name}/wordpress"

class { '::mcommons': }

class { '::mcommons::mysql':
  daily_backup => true,
  php_enable   => true,
}

class { '::mcommons::apache':
  force_ssl => true,
  snakeoil  => true,
  php       => true,
  opcache   => 'On',
}
