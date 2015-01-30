<?php
// Add metabox data to RSS feed
add_filter('pre_get_posts','feedFilter');
function feedFilter($query) {
  if ($query->is_feed) {
    add_filter('the_content', 'feedContentFilter');
  }
  return $query;
}

function feedContentFilter($content) {
  $before_content = " ";
  $after_content = " ";

  // Preamble
  $preamble = get_post_meta(get_the_id(), '_metabox_preamble', true);

  if ( !empty( $preamble["preamble"] ) ) {
     $before_content .= $preamble["preamble"] . " ";
  }

  // Featured image
  if ( has_post_thumbnail() ) {
    $before_content .= the_post_thumbnail('medium');
  }

  // Facts
  $facts = get_post_meta(get_the_id(), '_metabox_facts', true);
  if ( !empty( $facts )) {
    $after_content .= "<h2>Fakta</h2>" . wpautop($facts['facts']);
  }

  // Read more links
  $read_more = get_post_meta(get_the_id(), '_metabox_links', true);
  if ( !empty($read_more) ) {
    $after_content .= "<h2>Läs mer</h2>";
    $after_content .= "<ul>";
    foreach ( $read_more['links'] as $link) {
      if (!empty($link['link'])) {
        $after_content .= "<li><a href='{$link['link']}'>{$link['title']}</a></li>";
      }
    }
    $after_content .= "</ul>";
  }

  return $before_content . $content . $after_content;
}

/* Register new taxonomies */
function create_meta_taxonomies() {
  register_taxonomy('target', array('post'), array(
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
    'rewrite' => array( 'slug' => 'target' ),
    'capabilities' => array (
      'manage_terms' => 'manage_categories',
      'edit_terms' => 'manage_categories',
      'delete_terms' => 'manage_categories',
      'assign_terms' => 'manage_categories'
     )));
}
add_action( 'init', 'create_meta_taxonomies', 0 );

// Remove the "assign taxonomy target" from non-admins
if (is_admin()) {
  function my_remove_meta_boxes() {
   if(!current_user_can('administrator')) {
    remove_meta_box('targetdiv', 'post', 'normal');
   }
  }
  add_action( 'admin_menu', 'my_remove_meta_boxes' );
}

add_action( 'after_setup_theme', 'load_language' );
function load_language() {
  load_child_theme_textdomain( 'malmo', get_stylesheet_directory() . '/languages' );
}

// Add featured image thumbnail to RSS feed
add_action("do_feed_rss2","wp_rss_img_feed",5,1);
function wp_rss_img_feed(){
    add_action('rss2_item', 'wp_rss_img');
    add_action('rss2_ns', 'add_rss2_ns');
    add_action('commentrss2_item', 'wp_rss_img');
}
function wp_rss_img($content) {
  global $post;
  $small = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');
  $medium = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium');
  $large = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');

  if ($small) {
    echo  "<enclosure url='{$small[0]}' dashboard:url-medium='{$medium[0]}' dashboard:url-large='{$large[0]}' type='" . get_post_mime_type(get_post_thumbnail_id()) . "'/>";
  }
}

function add_rss2_ns() {
  echo 'xmlns:dashboard="http://komin.malmo.se/dashboard"';
}

function internal_news_scripts() {
	wp_enqueue_style('internal_news_style', get_stylesheet_directory_uri() . "/stylesheets/application.css");
}
add_action( 'wp_enqueue_scripts', 'internal_news_scripts' );
