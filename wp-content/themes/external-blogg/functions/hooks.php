<?php
add_action( 'after_setup_theme', 'load_language' );
function load_language() {
  load_child_theme_textdomain( 'malmo', get_stylesheet_directory() . '/languages' );
}

// Hack to prevent master from overriding
function let_child_rule() {
  return true;
}

/* Add gravatar image to rss feed */
function wp_rss_img_include($comment) {
  $email = $comment ? get_comment_author_email() : get_the_author_meta('user_email');
  $email = md5( strtolower( trim($email) ) );
  if ( is_ssl() ) {
    $avatar_url = 'https://secure.gravatar.com';
  } else {
    $avatar_url = 'http://1.gravatar.com';
  }
  $avatar_url .= '/avatar/' . $email . '?d=mm&amp;s=100.jpg';
  echo '<enclosure url="' . $avatar_url . '" type="image/jpeg"/>';
}
function wp_rss_img_do_feed(){
  add_action('rss2_item', 'wp_rss_img_include');
  add_action('commentrss2_item', 'wp_rss_img_include');
}
add_action("do_feed_rss2","wp_rss_img_do_feed",5,1);

// Force the full name to be displayed if we have it
add_filter('the_author', 'author_full_name');
function author_full_name($default) {
  $name = get_the_author_meta('first_name') . " " . get_the_author_meta('last_name');
  return strlen($name) > 1 ? $name : $default;
}

// Force the full name to be saved with a comment if user is logged in and we have it
add_filter('preprocess_comment', 'preprocess_comment_f');
function preprocess_comment_f($default) {
  if (is_user_logged_in()) {
    global $current_user;
    $full_name = $current_user->user_firstname . " " . $current_user->user_lastname;
    $default['comment_author'] = strlen($full_name) > 1 ? $full_name : $default['comment_author'];
  }
  return $default;
}

// Add contact fields
function add_contact_fields( $contactmethods ) {
    $contactmethods['working_title'] = 'Tjänstetitel';
    $contactmethods['department'] = 'Arbetsplats';
    unset($contactmethods['aim']);
    unset($contactmethods['jabber']);
    unset($contactmethods['yim']);
    return $contactmethods;
}
add_filter('user_contactmethods','add_contact_fields',10,1);

function add_theme_caps() {
  $role = new WP_Role('contributor');
  $role->add_cap( 'upload_files', true );
}
add_action( 'admin_init', 'add_theme_caps');
