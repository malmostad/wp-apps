<?php
/**
 * Template Name: Archive
 */
 get_header();
?>
<main class="archive" role="main">
  <h1 class="body-copy"><?php echo get_the_title(); ?></h1>
  <nav class="basic">
    <ul>
      <?php wp_get_archives( array('show_post_count' => true) ); ?>
    </ul>
  </nav>
</main>
<?php get_template_part('aside'); ?>
<?php get_footer(); ?>
