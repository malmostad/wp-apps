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

function log_debug($log)  {
  if (true === WP_DEBUG) {
    if (is_array($log) || is_object($log)) {
      error_log(print_r($log, true) );
    } else {
      error_log($log);
    }
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

// Cut the text to $limit number of chars
function truncate_excerpt_chars($text, $limit) {
  $text = do_shortcode($text);
  $text = strip_tags($text);
  $text = preg_replace('/\s\s+/', ' ', $text);
  return mb_substr($text, 0, $limit);
}

function get_top_posts($except = null, $max = 5) {
  return new WP_Query(array(
    'posts_per_page' => $max,
    'post__not_in' => array($except)
  ));
}

function get_gravatar_url($email) {
  return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . "?s=180&amp;d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D139";
}
