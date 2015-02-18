<?php

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
