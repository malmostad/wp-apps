$envs = ['development']

$runner_name  = 'vagrant'
$runner_group = 'vagrant'
$runner_home  = '/home/vagrant'
$runner_path  = '/usr/local/sbin:/usr/local/bin:/usr/bin:/bin'

$app_name = 'wordpress'
$app_home = '/vagrant'
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

  class { '::mcommons::mysql':
    db_password      => '',
    db_root_password => '',
    daily_backup     => false,
    php_enable       => true,
  }

  class { '::mcommons::apache':
    port      => 8000,
    ssl       => false,
    force_ssl => false,
    php       => true,
    opcache   => 'Off',
  }

  class { '::mcommons::wordpress':
    table_prefix => '',
    plugins      => $::wp_plugins,
  }
}
