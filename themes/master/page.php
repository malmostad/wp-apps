<?php
/**
 * The template for displaying all pages.
 */
get_header(); ?>
<main role="main">
  <article class="body-copy">
  	<?php while (have_posts()): the_post(); ?>

  		<h1><?php the_title(); ?></h1>

      <?php if ( has_post_thumbnail() ) { ?>
        <div class="featured-image">
          <?php the_post_thumbnail('medium', array('class' => 'article-image')) ?>
        </div>
      <?php } ?>

  		<?php the_content(); ?>
  		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . 'Sidor: ', 'after' => '</div>' ) ); ?>

    <?php endwhile; ?>
  </article>

  <?php if (is_user_logged_in()): ?>
    <a class="btn btn-mini edit" href="<?php echo get_edit_post_link() ?>">Redigera</a>
  <?php endif; ?>
  <?php comments_template( '', true ); ?>
</main>
<?php get_template_part('aside'); ?>
<?php get_footer(); ?>
