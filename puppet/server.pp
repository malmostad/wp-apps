$envs = ['production']

$runner_name  = 'app_runner'
$runner_group = 'app_runner'
$runner_home  = '/home/app_runner'
$runner_path  = '/usr/local/sbin:/usr/local/bin:/usr/bin:/bin'

$app_name = 'wordpress'
$app_home = "${::runner_home}/wordpress-custom/current"
$doc_root = "${::runner_home}/wordpress"

$wp_plugins = [
  'https://downloads.wordpress.org/plugin/akismet.3.1.1.zip',
  'https://downloads.wordpress.org/plugin/auto-hyperlink-urls.4.0.zip',
  'https://downloads.wordpress.org/plugin/content-scheduler.2.0.5.zip',
  'https://downloads.wordpress.org/plugin/valideratext.2.0.zip',
  'https://downloads.wordpress.org/plugin/wpdirauth.1.7.6.zip',
]

# To just upgrade WP and the plugins as defined in $wp_plugins, run:
# $ sudo FACTER_WP_UPGRADE=true puppet apply puppet/vagrant.pp
if $::wp_upgrade {
  class { '::mcommons::wordpress::install': }
  ::mcommons::wordpress::install_plugins { $::wp_plugins: }
}

# Full installation and configuration
else {
  class { '::mcommons': }

  -> class { '::mcommons::mysql':
    php_enable => true,
  }

  -> class { '::mcommons::apache':
    php => true,
  }

  -> class { '::mcommons::wordpress': }
}
