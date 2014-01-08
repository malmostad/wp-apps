<?php
/**
 * Template Name: Help
 */
  get_header();
?>
<section class="help" role="main">
  <h1 class="page-title"><?php echo get_the_title(); ?></h1>
  <?php wp_nav_menu( array( 'menu' => 'Help', 'menu_id' => 'help', 'items_wrap' => '<ul>%3$s</ul>',  'depth' => 1 ) ); ?>
</section>

<?php
  get_template_part('aside');
  get_footer(); 
?>
