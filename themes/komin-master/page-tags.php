<?php
/**
 * Template Name: Tags
 */
  get_header();
?>

<section class="tags">
  <nav>
    <?php wp_tag_cloud(array(
    	'smallest'=> 0.7,
        'largest' => 3,
        'unit'    => 'em',
        'number'  => 200,
        'order'   => 'rand')
    ); ?>
  </nav>
</section>
<?php get_footer(); ?>
