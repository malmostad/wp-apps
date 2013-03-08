<?php
// Set SAVEQUERIES in wp-config to log sql queries
function log_db_queries() {
  if ( SAVEQUERIES ) {
    global $wpdb;
    error_log(var_export($wpdb->queries, true));
    $sum = 0;
    foreach ($wpdb->queries as $query) { $sum +=  $query[1]; }
    error_log("TOTAL SQL TIME: " . $sum);
  }
}

// Cut the text to $limit number of words
function truncate_excerpt($text, $limit) {
  $text = do_shortcode($text);
  $text = strip_tags($text);
  $words = explode(' ', $text);

  if ( count( $words ) > $limit ) {
    $text = implode(' ', array_slice($words, 0, $limit)) . '&nbsp;&hellip;';
  }
  return $text;
}

function get_top_posts($except = null, $max = 5) {
  return new WP_Query(array(
    'posts_per_page' => $max,
    'post__not_in' => array($except)
  ));
}
