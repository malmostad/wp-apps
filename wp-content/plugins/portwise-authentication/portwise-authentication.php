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
  }

  public function signon() {
    error_log("portwise_authentication");
    if (!is_user_logged_in()) {
      error_log("START AUTH");
      $username = 'martha2';
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
    wp_logout();
    wp_redirect(PORTWISE_SIGNOUT_URL);
  }

  private function trust_request() {
    // Check that the request comes from Portwise, i.e. provides:
    //   an X-UID header
    //   PORTWISE_IP_ADDRESS
    //   PORTWISE_TOKEN
    //   PORTWISE_REQUIRE_SSL
  }

  private function add_user($userdata) {
    wp_insert_user($userdata);
  }

  private function update_user($userdata) {
    wp_update_user($userdata);
  }
}
