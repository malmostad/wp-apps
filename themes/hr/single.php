<?php get_header(); ?>
<article class="body-copy">
  <?php while (have_posts()): the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <?php if ( has_post_thumbnail() ): ?>
      <div class="featured-image">
        <?php the_post_thumbnail('medium', array('class' => 'article-image')) ?>
      </div>
    <?php endif ?>

    <?php the_content(); ?>

    <?php
      $postID = $post->ID;
    endwhile; ?>
  </article>

<?php if (current_user_can( 'edit_posts' )): ?>
  <a class="btn edit" href="<?php echo get_edit_post_link() ?>">Redigera</a>
<?php endif; ?>
<?php get_footer(); ?>
