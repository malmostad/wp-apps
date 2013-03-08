<?php

// Get the meta field "preamble" or the excerpt as a fallback
// $limit Number of words
function preamble($id, $limit = 70) {
  $preamble = get_post_meta($id, '_metabox_preamble', true);
  if (!empty($preamble['preamble'])) {
    return truncate_excerpt($preamble['preamble'], $limit);
  } 
  else {
    return "";
  }
}

function get_top_news($except = null, $max = 5) {
   return new WP_Query(array(
    'tax_query' => array(
      array(
        'taxonomy' => 'target',
        'field'    => 'slug',
        'terms'    => 'var-kommun'
      )
    ),
    'posts_per_page' => $max,
    'post__not_in' => array($except)
  ));
}

