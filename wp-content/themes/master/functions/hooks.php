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
  $init['block_formats'] = "Stycke=p;Rubrik 2=h2;Rubrik 3=h3";
  $init['toolbar1'] = "undo,redo,|,formatselect,|,italic,|,bullist,numlist,outdent,indent,blockquote,|,pastetext,pasteword,removeformat,|,link,unlink,|,valideratext,|,wp_help,|,dfw";
  $init['toolbar2'] = "";
  $init['paste_word_valid_elements'] = "@[class],p,h2,h3,a[href],em,div,table,tbody,thead,tr,td,ul,ol,li,img[src|alt]";
  // $init['valid_elements'] = "@[class|id],div,p,h2,h3,a[href],em,br,table,tbody,thead,tr,td,ul,ol,li,img[src|alt|class]";
  $init['paste_auto_cleanup_on_paste'] = true;
  $init['paste_remove_styles'] = true;
  $init['paste_remove_styles_if_webkit'] = true;
  $init['theme_advanced_status_info'] = true;
  return $init;
}
add_filter('tiny_mce_before_init', 'set_mce_options');

function clean_on_save($content) {
  $content = preg_replace("/&nbsp;/", "", $content);
  return $content;
}
add_action('content_save_pre', 'clean_on_save');

global $mconfig;

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
if (isset($mconfig['avtar_base_url'])) {
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

function my_wp_title($title, $sep) {
  global $paged, $page;

  if (is_tax()) {
    $term = get_queried_object();
    if (is_feed()) {
      return  " $sep $term->name";
    }
    $title = "$term->name $sep ";
  }
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && (is_home() || is_front_page())) {
    $title = "$title $sep $site_description";
  }
  return $title;
}
add_filter('wp_title', 'my_wp_title', 10, 2);

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
  $role = get_role('contributor');
  $role->add_cap( 'upload_files', true );
}
add_action( 'admin_init', 'add_theme_caps');

function include_theme_scripts() {
  // Include the child themes application.css. See style.css for Sass compiling instructions
	wp_enqueue_style('child_theme_style', get_stylesheet_directory_uri() . "/stylesheets/application.css");
}
add_action( 'wp_enqueue_scripts', 'include_theme_scripts' );
