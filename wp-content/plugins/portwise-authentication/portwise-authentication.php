<?php
/*
  Plugin Name: Portwise Authentication
  Plugin URI: https://github.com/malmostad/intranet-wordpress-themes
  Description: Authentication with Portwise reveresed proxy http headers method
               If user is present, it is updated with attributes from Portwise
               If user isn't present, it is created with attributes from Portwise
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
    $_SERVER['HTTP_X_TOKEN'] = PORTWISE_TOKEN;
    $_SERVER['HTTP_X_UID'] = "martha2";
  }

  public function signon() {
    error_log("portwise_authentication");
    if ($this->trust_request() && !is_user_logged_in()) {
      error_log("START AUTH");

      if (username_exists($this->username)) {
        $user = get_user_by('login', $this->$username);
        $this->update_user($user);
      } else {
        $user = $this->add_user();
      }

      if ($user) {
        wp_set_current_user($user->ID, $user->user_login);
        wp_set_auth_cookie($user->ID, false, PORTWISE_REQUIRE_SSL);
        do_action('wp_login', $user->user_login);
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
        isset($_SERVER['HTTP_X_UID']) &&
        (PORTWISE_REQUIRE_SSL ? $_SERVER['HTTPS'] == "on" : true));
  }

  private function add_user() {
    $id = wp_insert_user(array(
      'user_login'   => $this->username(),
      'user_email'   => $this->email(),
      'nickname'     => $this->nickname(),
      'display_name' => $this->display_name(),
      'user_pass'    => wp_generate_password(64, true, true) // unusable pw
    ));
    return get_user_by('id', $id);
  }

  private function update_user($user) {
    return wp_update_user(array(
      'id'           => $user->ID,
      'user_email'   => $this->email(),
      'nickname'     => $this->nickname(),
      'display_name' => $this->display_name()
    ));
  }

  private function username() {
    return $_SERVER['HTTP_X_UID'];
  }

  private function display_name() {
    return $_SERVER['HTTP_X_DISPLAYNAME']? $_SERVER['HTTP_X_DISPLAYNAME'] : $_SERVER['HTTP_X_UID'];
  }

  private function nickname() {
    return $this->displayname();
  }

  private function email() {
    return $_SERVER['HTTP_X_EMAIL']? $_SERVER['HTTP_X_EMAIL'] : "{$_SERVER['HTTP_X_UID']}@malmo.se";
  }
}
