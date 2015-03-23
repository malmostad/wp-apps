$envs = ['development']

$runner_name  = 'vagrant'
$runner_group = 'vagrant'
$runner_home  = '/home/vagrant'
$runner_path  = '/usr/local/sbin:/usr/local/bin:/usr/bin:/bin'

$app_name       = 'wordpress'
$app_home       = "${::runner_home}/${::app_name}"
# $app_home       = '/vagrant'

class { '::mcommons::wordpress::install':
  tar_gz_url => $tar_gz_url
}
