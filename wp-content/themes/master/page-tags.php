<?php
/**
 * Template Name: Tags
 */
  get_header();
?>

<main class="tags" role="main">
  <nav>
    <?php wp_tag_cloud(array(
    	'smallest'=> 0.7,
        'largest' => 3,
        'unit'    => 'em',
        'number'  => 200,
        'order'   => 'rand')
    ); ?>
  </nav>
</main>
<?php get_footer(); ?>
