$envs = ['production']

$runner_name  = 'app_runner'
$runner_group = 'app_runner'
$runner_home  = '/home/app_runner'
$runner_path  = '/usr/local/sbin:/usr/local/bin:/usr/bin:/bin'

$app_name = 'wordpress'
$app_home = "${::runner_home}/wordpress-custom/current"

class { '::mcommons': }

class { '::mcommons::mysql':
  php_enable => true,
}

class { '::mcommons::apache':
  ssl       => true,
  force_ssl => true,
  php       => true,
  opcache   => 'On',
}

class { '::mcommons::wordpress': }
