<?php
/**
 * Template Name: Authors
 */
get_header(); ?>

<section class="authors" role="main">
  <h1 class="page-title"><?php echo get_the_title(); ?></h1>
  <ul>
    <?php wp_list_authors( array( 'show_fullname' => 1,
        'optioncount' => 1,
        'orderby' => 'name')); 
    ?>
  </ul>
</section>

<?php get_template_part('aside'); ?>
<?php get_footer(); ?>
