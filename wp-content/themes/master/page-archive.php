<?php
/**
 * Template Name: Archive
 */
 get_header();
?>
<main class="archive" role="main">
  <h1 class="body-copy"><?php echo get_the_title(); ?></h1>
  <ul>
    <?php wp_get_archives( array('show_post_count' => true) ); ?>
  </ul>
</main>
<?php get_template_part('aside'); ?>
<?php get_footer(); ?>
