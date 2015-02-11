<?php
define('DB_NAME', 'db_name');
define('DB_USER', 'db_user');
define('DB_PASSWORD', 'secret');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_swedish_ci');
$table_prefix  = '';

# Regenerate at https://api.wordpress.org/secret-key/1.1/salt/ }
define('AUTH_KEY',         'Bfb<b %xSV=diXfR>[u|xys, m#Op:aA}=YW&Q=(/vbz9yD7V/(t#9B{+^(SP0}C');
define('SECURE_AUTH_KEY',  'H*/j|_td cEif`C`eQ]gqKx|ZqA:C1NlpzRW=I&22AJ3 DZp!#-oSQrb~L;_|Rp6');
define('LOGGED_IN_KEY',    '(|Z7$0~./Q8_y<o:Z:-*vT0+k>}S|>*Vki@fk.ev$kCEXlw=)@tc+v<}R}wwSa0$');
define('NONCE_KEY',        ',,6VqW|PO)DLO[[/:oG=IRg-bYn767b_mqf (|X DFEN2KPR5>)oKK}f$95qY^b{');
define('AUTH_SALT',        'iL{iTroiYApIbQ+@I_WtpJFP+&2ycTbq-Y24MM}K[;n[zIF(:<q8FaNd+|U5+-wm');
define('SECURE_AUTH_SALT', 'KL+[ i3nd[OK|E@i6F0US3VBi--;H7)hKAQPDbfAdJ[3r]#X$|j0-G+W;dbu{vFc');
define('LOGGED_IN_SALT',   '~#VQP-6%wh>g@h|u,.96hc+G#&1=J44nL/dVE-P^0~C1:~^d+p|ulNL0&Zxb`nG.');
define('NONCE_SALT',       '&Te-Rjc*0dd-VXga&W$@7~VkzkfbP)Dt+X6+AgHJK0`u{@XZQ%zwQkNR=yc.g|F0');

define('WP_SITEURL', 'http://www.local.malmo.se/ws/wp-komin');
define('WP_HOME',    'http://www.local.malmo.se/ws/wp-komin');

define ('WPLANG', 'sv_SE');
define('ENV', 'development');


define('PORTWISE_IP_ADDRESS',
  '123.123.123.123,
   123.123.123.124,
   123.123.123.125');

define('PORTWISE_TOKEN', 'secret');
define('PORTWISE_REQUIRE_SSL', true);
define('PORTWISE_SIGNOUT_URL', 'https://pw.example.org/wa/logout');

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('SAVEQUERIES', false );

define('FORCE_SSL_LOGIN', false);

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
