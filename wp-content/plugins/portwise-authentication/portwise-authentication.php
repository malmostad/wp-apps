<?php
/*
  Plugin Name: Portwise Authentication
  Plugin URI: https://github.com/malmostad/intranet-wordpress-themes
  Description: Authentication with Portwise reveresed proxy http headers method
  Version: 0.0.1
  Author: Malmö stad
  Author URI: https://github.com/malmostad

  Define the following constants in wp-config.php:
    define('PORTWISE_IP_ADDRESS', '123.123.123.123');
    define('PORTWISE_TOKEN', 'long token');
    define('PORTWISE_REQUIRE_SSL', true);
    define('PORTWISE_SIGNOUT_URL', 'https://sso.example.org/wa/logout');
*/

$portwise = new PortwiseAuthentication();

class PortwiseAuthentication {
  function __construct() {
    add_action('after_setup_theme', array($this, 'signon'));
    add_action('wp_logout', array($this, 'signout'));
    error_log("TRUST: " . $this->trust_request());
  }

  public function signon() {
    error_log("portwise_authentication");
    if (!is_user_logged_in()) {
      error_log("START AUTH");
      $username = 'admin';
      if (get_user_by('login', $username)) {
        $user = get_user_by('login', $username);
        wp_set_current_user($user->ID, $user->user_login);
        wp_set_auth_cookie($user->ID, false, PORTWISE_REQUIRE_SSL);
        do_action('wp_login', $user->user_login);
        error_log("is_user_logged_in: " . is_user_logged_in());
      }
    }
  }

  public function signout() {
    wp_clear_auth_cookie();
    wp_redirect(PORTWISE_SIGNOUT_URL);
    exit;
  }

  private function trust_request() {
    return ($_SERVER['REMOTE_ADDR'] == PORTWISE_IP_ADDRESS && // HTTP_CLIENT_IP HTTP_X_FORWARDED_FOR
        $_SERVER['HTTP_X_TOKEN'] == PORTWISE_TOKEN &&
        !empty($_SERVER['HTTP_X_UID']) &&
        (PORTWISE_REQUIRE_SSL ? $_SERVER['HTTPS'] == "on" : true));
  }

  private function add_user($userdata) {
    wp_insert_user($userdata);
  }

  private function update_user($userdata) {
    wp_update_user($userdata);
  }
}
