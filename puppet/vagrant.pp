$envs = ['development']

$runner_name  = 'vagrant'
$runner_group = 'vagrant'
$runner_home  = '/home/vagrant'
$runner_path  = '/usr/local/sbin:/usr/local/bin:/usr/bin:/bin'

$app_name = 'wordpress'
$app_home = '/vagrant'
$doc_root = "${::runner_home}/wordpress"

# To just upgrade Wordpress
# $ sudo FACTER_WP_UPGRADE=true puppet apply puppet/vagrant.pp
if $::wp_upgrade {
  class { '::mcommons::wordpress::install': }
}

# Full installation and configuration
else {
  class { '::mcommons': }

  -> class { '::mcommons::mysql':
    db_password      => '',
    db_root_password => '',
    daily_backup     => false,
    php_enable       => true,
  }

  -> class { '::mcommons::apache':
    port      => 8000,
    ssl       => false,
    force_ssl => false,
    php       => true,
    opcache   => 'Off',
  }

  -> class { '::mcommons::wordpress':
    table_prefix => '',
  }

  -> class { '::mcommons::wordpress::vagrant':
    capistrano_tasks => ['local:update_plugins'],
  }
}
