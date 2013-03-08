<?php
// WP hooks

if (!isset( $content_width)) $content_width = 576;

function theme_setup() {
  add_editor_style( 'stylesheets/editor-style.css' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'automatic-feed-links' );
}
add_action( 'after_setup_theme', 'theme_setup' );

// Add featured image thumbnail to RSS feed
add_action("do_feed_rss2","wp_rss_img_do_feed",5,1);
function wp_rss_img_do_feed(){
    add_action('rss2_item', 'wp_rss_img_include');
    add_action('commentrss2_item', 'wp_rss_img_include');
}
function wp_rss_img_include($content) {
  global $post;
  $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');

  if ($thumbnail) {
    echo  "<enclosure url='{$thumbnail[0]}' type='" . get_post_mime_type(get_post_thumbnail_id()) . "' />";
  }
}


// TinyMCE customization
function set_mce_options( $init ) {
  $init['theme_advanced_blockformats'] = 'p, h2, h3, h4';
  // $init['theme_advanced_buttons1'] = "undo,redo,|,formatselect,|,italic,|,bullist,numlist,outdent,indent,blockquote,|,pastetext,pasteword,removeformat,|,link,unlink,|,fullscreen,|,wp_help";
  // $init['theme_advanced_buttons2'] = "";
  // $init['theme_advanced_status_info'] = false;
  return $init;
}
add_filter('tiny_mce_before_init', 'set_mce_options');
