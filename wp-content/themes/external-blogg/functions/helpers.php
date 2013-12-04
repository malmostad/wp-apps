<?php
/* Alter the posts query for the home page and global rss based on metadata settings for post  */
function home_query_posts() {
  query_posts( array(
    'tax_query' => array(
      array(
        'taxonomy' => 'metadata',
        'field' => 'slug',
        'terms' => 'hide-on-startpage',
        'operator' => 'NOT IN',
     )
    ),
    'paged' => get_query_var('paged')
  ));
}
