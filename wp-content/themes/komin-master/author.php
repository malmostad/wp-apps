<?php
  // Template for displaying Author Archive pages.
  get_header();

  if (have_posts()): the_post();
    $template_vars = array(
      'title' =>  __('Inlägg publicerade av ', 'malmo') . get_the_author(),
      'feed_url' => get_author_feed_link( get_the_author_meta( 'ID' ))
    );
  endif;
  rewind_posts();
  get_template_part('loop');
  get_template_part('aside');
  get_footer();
?>
