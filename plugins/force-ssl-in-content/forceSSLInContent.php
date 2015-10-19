<?php
/*
  Plugin Name: Force SSL in Content
  Plugin URI: https://github.com/malmostad/wp-apps
  Description: Replace http: with https: for inline images and media content from the same WP app
               Note: Images and media from other servers is not changed since we do not know if
               other servers support https:
  Version: 0.0.3
  Author: Malmö stad
  Author URI: https://github.com/malmostad
*/

add_filter('the_content', 'forceSSL');
function forceSSL($content) {
  return str_replace("http://{$_SERVER['SERVER_NAME']}", "https://{$_SERVER['SERVER_NAME']}", $content);
}
