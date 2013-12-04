<?php

if (!isset( $content_width)) $content_width = 512;

function theme_setup() {
  add_editor_style();
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'automatic-feed-links' );
  load_theme_textdomain( 'malmo', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'theme_setup' );

// Override remember me expire
function set_cookie_expire_filter( $default, $user_ID, $remember_me ) {
  if ($remember_me) {
    $default = 60 * 60 * 24 * 30;
  }
  return $default;
}
add_filter( 'auth_cookie_expiration', 'set_cookie_expire_filter', 10, 3 );

// TinyMCE customization
function set_mce_options( $init ) {
  $init['theme_advanced_blockformats'] = 'p,h2,h3';
  $init['theme_advanced_buttons1'] = "undo,redo,|,formatselect,|,italic,|,bullist,numlist,outdent,indent,blockquote,|,pastetext,pasteword,removeformat,|,link,unlink,|,valideratext,|,fullscreen,|,wp_help";
  $init['theme_advanced_buttons2'] = "";
  $init['theme_advanced_status_info'] = false;
  return $init;
}
add_filter('tiny_mce_before_init', 'set_mce_options');

global $mconfig;

// Add styles and script to admin views
if (is_admin())  {
  wp_enqueue_style('admin', get_template_directory_uri() . '/stylesheets/admin.css');
  wp_enqueue_script('admin', get_template_directory_uri() . '/javascripts/admin.js');
}

// Remove title tags. Parses all content markup. Might slow down page rendering.
add_filter('the_content', 'remove_img_titles', 1000);
add_filter('post_thumbnail_html', 'remove_img_titles', 1000);
function remove_img_titles($text) {
  // Get all title="..." tags from the html.
  $result = array();
  preg_match_all('|title="[^"]*"|U', $text, $result);

  // Replace all occurances with an empty string.
  foreach($result[0] as $img_tag) {
    $text = str_replace($img_tag, '', $text);
  }
  return $text;
}

function custom_login() {
  echo '<link rel="stylesheet" href="'.get_bloginfo('template_directory').'/stylesheets/admin.css" />';
}
add_action('login_head', 'custom_login');

// Use Malmo's avatar service instead of Gravatar
if (!function_exists('let_child_rule')) {
  add_filter( 'get_avatar', 'get_malmo_avatar', 10, 5 );
}

function get_malmo_avatar( $avatar, $id_or_email, $size, $url, $alt, $css = "" ) {
  global $mconfig;

  if ( is_numeric($id_or_email) )
    $user_id = (int) $id_or_email;
  elseif ( is_string( $id_or_email ) && ( $user = get_user_by( 'email', $id_or_email ) ) )
    $user_id = $user->ID;
  elseif ( is_object( $id_or_email ) && ! empty( $id_or_email->user_id ) )
    $user_id = (int) $id_or_email->user_id;

  if ( empty( $user_id ) )
    return "...";

  $user = get_userdata($user_id);
  $username = $user->user_login;

  // Map $size to the closest avatar width, round up
  $style = "";
  if ($size) {
    if ($size > 300 ) {
      $style = "xlarge";
    } elseif ($size > 180 ) {
      $style = "large_quadrat";
    } elseif ($size > 120 ) {
      $style = "medium_quadrat";
    } elseif ($size > 60 ) {
      $style = "small_quadrat";
    } elseif ($size > 46 ) {
      $style = "thumb_quadrat";
    } elseif ($size > 32 ) {
      $style = "tiny_quadrat";
    } elseif ($size > 0 ) {
      $style = "mini_quadrat";
    }
    if ($css) { $css = 'height: 100%; width:' . $size .'px'; }
  }
  return '<img class="avatar avatar-' . $size . ' photo" style="'. $css .'" src="' . $mconfig['avtar_base_url'] . $username .'/' . $style . '.jpg" alt="" />';
}

function remove_adminbar_style() {
  remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_adminbar_style');

// Allow redirect to dashboard. Used for logout redirect
add_filter('allowed_redirect_hosts','allow_domain_redirect');
function allow_domain_redirect($allowed) {
  $allowed[] = 'webapps06.malmo.se';
  return $allowed;
}
