<?php

/* Add filtered feed with custom template feed-rss2.php in theme */
function mainfeed() {
  $enclosure = wp_rss_img_do_feed(false);
  load_template( TEMPLATEPATH . '/feed-rss2.php');
}
add_action('do_feed_mainfeed', 'mainfeed', 10, 1);
add_rewrite_rule('mainfeed','index.php?feed=mainfeed','top');
remove_action( 'wp_head', 'feed_links', 2 );

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
  echo '<enclosure url="https:' . $mconfig['avtar_base_url'] . $user->user_login .'/small_quadrat.jpg" type="image/jpeg"/>';
}
