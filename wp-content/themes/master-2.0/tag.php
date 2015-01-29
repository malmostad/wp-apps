<?php
  // Template for displaying Tag Archive pages.
  get_header();
  $template_vars = array( 
    'title' => 'Etikett: ' . single_tag_title('', false),
    'feed_url' => get_tag_feed_link(get_query_var('tag_id'))
  );
  get_template_part('loop');
  get_template_part('aside');
  get_footer();
?>
