<?php
/*
  Plugin Name: Force Login
  Plugin URI: https://github.com/malmostad/intranet-wordpress-themes
  Description: Require login for all access except for feeds
  Version: 0.0.1
  Author: Malmö stad
  Author URI: https://github.com/malmostad
*/

# Redirect user to login form if not already logged in
add_action('template_redirect','force_login');
function force_login () {
  if (!is_user_logged_in() && !is_feed()) {
    auth_redirect();
  }
}
