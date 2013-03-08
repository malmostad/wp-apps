<?php
/**
 * Template Name: Archive
 */
 get_header();
?>
<section class="archive" role="main">
  <h1 class="page-title"><?php echo get_the_title(); ?></h1>
  <ul>
    <?php wp_get_archives( array('show_post_count' => true) ); ?>
  </ul>
</section>
<?php get_template_part('aside'); ?>
<?php get_footer(); ?>
