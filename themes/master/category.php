<?php
  // Template for displaying Category Archive pages.
  get_header();

  $template_vars = array(
    'title' =>  'Kategori: ' . single_cat_title( '', false ),
    'feed_url' => get_category_feed_link(get_cat_ID( single_cat_title('', false )))
  );
  get_template_part('loop');
  get_template_part('aside');
  get_footer();
?>
