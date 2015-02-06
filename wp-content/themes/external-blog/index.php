<?php
  get_header();
  $template_vars = array('feed_url' => get_bloginfo('url') . '/feed' );
  get_template_part('loop');
  get_template_part('aside');
  get_footer();
?>
