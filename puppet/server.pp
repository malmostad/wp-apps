$envs = ['production']

$runner_name  = 'app_runner'
$runner_group = 'app_runner'
$runner_home  = '/home/app_runner'
$runner_path  = '/usr/local/sbin:/usr/local/bin:/usr/bin:/bin'

$app_name = 'wordpress'
$app_home = "${::runner_home}/wordpress-custom/current"
$doc_root = "${::runner_home}/wordpress"

# To just upgrade Wordpress:
# $ sudo FACTER_WP_UPGRADE=true puppet apply [vagrant|server].pp
if $::wp_upgrade {
  class { '::mcommons::wordpress::install': }
}

# Full installation and configuration
else {
  class { '::mcommons': }

  -> class { '::mcommons::mysql':
    php_enable => true,
  }

  -> class { '::mcommons::apache':
    php      => true,
    snakeoil => true,
  }

  -> class { '::mcommons::wordpress':
    table_prefix => '', # Change to 'wp_' if you're not about to import an existing db
  }
}
