<?php
/* Get voters data by ajax for a specifc post */
function get_voters() {
  $voters = GetPostVotes($_POST['post_id']);
  $out = '<ul>';
  $c = 0;
  foreach ($voters as $voter) {
    if (!empty($voter)) {
      $c++;
      $voter_data = get_userdata($voter);
      $out .= '<li>';
      $link = '<a href="' . get_author_posts_url($voter_data->ID) . '">';
      $name = (!empty($voter_data->first_name) && !empty($voter_data->last_name)) ? ($voter_data->first_name . " " . $voter_data->last_name) : $voter_data->display_name;
      $out .= $link . get_avatar($voter_data->user_email, 50, null , $name) . '</a>';
      $out .= $link . $name . '</a>';
      $out .= '</li>';
    }
  }
  // Sum anonymouse voters
  $anonymous = GetVotes($_POST['post_id']) - $c;
  if ($anonymous) {
    $out .= "<li class='anon'>{$anonymous} har röstat anonymt</li>";
  }
  $out .= '</ul>';
  echo $out;
  die;
}
add_action('wp_ajax_get_voters', 'get_voters');
add_action('wp_ajax_nopriv_get_voters', 'get_voters');

/* New taxonomy "metadata" */
function create_meta_taxonomies() {
  register_taxonomy('metadata', array('post'), array(
    'hierarchical' => true,
    'labels' => array(
      'name' => 'Publiceringsstyrning',
      'singular_name' => 'Publiceringsstyrning',
      'search_items' =>  'Sök',
      'all_items' => 'Alla fält',
      'edit_item' => 'Redigera fält',
      'update_item' => 'Uppdatera fält',
      'add_new_item' => 'Lägg till nytt fält',
      'new_item_name' => 'Nytt fält',
      'menu_name' => 'Publiceringsstyrning',
    ),
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'metadata' ),
  ));
}
add_action( 'init', 'create_meta_taxonomies', 0 );

/* Add filtered feed with custom template feed-rss2.php in theme */
function mainfeed() {
  $enclosure = wp_rss_img_do_feed(false);
  load_template( TEMPLATEPATH . '/feed-rss2.php');
}
add_action('do_feed_mainfeed', 'mainfeed', 10, 1);
add_rewrite_rule('mainfeed','index.php?feed=mainfeed','top');
remove_action( 'wp_head', 'feed_links', 2 );

add_action( 'after_setup_theme', 'load_language' );
function load_language() {
  load_child_theme_textdomain( 'malmo', get_stylesheet_directory() . '/languages' );
}

/* Add avatar image to rss feed */
function wp_rss_img_do_feed(){
  add_action('rss2_item', 'wp_rss_img_include');
  add_action('commentrss2_item', 'wp_rss_img_include');
}
add_action("do_feed_rss2","wp_rss_img_do_feed",5,1);
function wp_rss_img_include($comment) {
  global $mconfig;
  $email = $comment ? get_comment_author_email() : get_the_author_meta('user_email');
  $user = get_user_by( 'email', $email );
  echo '<enclosure url="http:' . $mconfig['avtar_base_url'] . $user->user_login .'/small_quadrat.jpg" type="image/jpeg"/>';
}
