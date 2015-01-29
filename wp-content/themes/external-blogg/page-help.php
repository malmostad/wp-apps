<?php
/**
 * Template Name: Help
 */
  get_header();
?>
<main class="help" role="main">
  <h1 class="body-copy"><?php echo get_the_title(); ?></h1>
  <?php wp_nav_menu( array( 'menu' => 'Help', 'menu_id' => 'help', 'items_wrap' => '<ul>%3$s</ul>',  'depth' => 1 ) ); ?>
</main>

<?php
  get_template_part('aside');
  get_footer();
?>
