<?php
  get_header();
  $template_vars = array('title' => __('Alla inlägg', 'malmo'), 'feed_url' => get_bloginfo('url') . '/feed' );
  get_template_part('loop');
  get_footer();
?>
