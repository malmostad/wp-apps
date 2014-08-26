<?php
/*
  Plugin Name: Portwise Authentication
  Plugin URI: https://github.com/malmostad/intranet-wordpress-themes
  Description: Authentication with Portwise reveresed proxy http headers method.
               If user is present, it is updated with attributes from Portwise.
               If user isn't present, it is created with attributes from Portwise.
               This is a non-GUI plugin relying on wp-config settings.
  Version: 0.0.1
  Author: Malmö stad
  Author URI: https://github.com/malmostad

  Instructions:
    Define the following constants in wp-config.php:
      define('PORTWISE_IP_ADDRESS', '123.123.123.123');
      define('PORTWISE_TOKEN', 'long token');
      define('PORTWISE_REQUIRE_SSL', true);
      define('PORTWISE_SIGNOUT_URL', 'https://sso.example.org/wa/logout');
*/

$portwise = new PortwiseAuthentication();

class PortwiseAuthentication {
  function __construct() {
    if ($this->trust_request()) {
      add_action('after_setup_theme', array($this, 'signon'));
      add_action('wp_logout', array($this, 'signout'));
    }
  }

  public function signon() {
    error_log("portwise_authentication");
    if (!is_user_logged_in()) {
      error_log("START AUTH");

      if (username_exists($this->username())) {
        error_log("User exits");
        $user = get_user_by('login', $this->username());
        $this->update_user($user);
      } else {
        error_log("User dosn't exit");
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
    if (is_wp_error($id)) {
      error_log($id->get_error_message());
      return false;
    }

    // Set profile to auth with wpDirAuth when not on SSO
    update_user_meta($id, 'wpDirAuthFlag', 1);

    return get_user_by('id', $id);
  }

  private function update_user($user) {
    $id = wp_update_user(array(
      'ID'           => $user->ID,
      'user_email'   => $this->email(),
      'nickname'     => $this->nickname(),
      'display_name' => $this->display_name()
    ));
    if (is_wp_error($id)) {
      error_log($id->get_error_message());
      return false;
    }
    return $id;
  }

  private function username() {
    return $_SERVER['HTTP_X_UID'];
  }

  private function display_name() {
    return !empty($_SERVER['HTTP_X_DISPLAYNAME']) ? $_SERVER['HTTP_X_DISPLAYNAME'] : $_SERVER['HTTP_X_UID'];
  }

  private function nickname() {
    return $this->display_name();
  }

  private function email() {
    return !empty($_SERVER['HTTP_X_EMAIL']) ? $_SERVER['HTTP_X_EMAIL'] : "{$_SERVER['HTTP_X_UID']}@malmo.se";
  }
}
