<?php get_header(); ?>
<main role="main" class="post">
  <?php while (have_posts()): the_post(); ?>
    <h1 class="body-copy"><?php the_title(); ?></h1>

    <section class="meta">
      <?php get_template_part('author-meta') ?>

      <?php get_template_part('single-meta') ?>
      <?php get_template_part('social-links') ?>

      <script>
        var blogTracking = {
          author: "<?php the_author() ?>",
          categories: [ <?php foreach((get_the_category()) as $category) { echo '"' . htmlspecialchars_decode($category->cat_name) . '",'; } ?> ]
        };
      </script>

      <?php edit_post_link('Redigera', '<span class="btn btn-default btn-sm edit">', '</span>'); ?>
    </section>

    <div class="article-and-comments">
      <article class="body-copy">
        <?php if (has_post_thumbnail()): ?>
          <div class="featured-image">
            <?php the_post_thumbnail('medium', array('class' => 'article-image')) ?>
          </div>
        <?php endif;
          the_content();
          $postID = $post->ID;
        ?>
        <?php get_template_part('single-meta') ?>
      </article>
      <?php comments_template( '', true ); ?>
    </div>
  <?php endwhile; ?>

  <nav>
    <ul class="pagination">
      <li class="previous"><?php previous_post_link( '%link', 'Föregående' ); ?></li>
      <li class="next"><?php next_post_link( '%link', 'Nästa' ); ?></li>
    </ul>
  </nav>
</main>

<?php
  $template_vars = array('postID' => $postID);
  get_template_part('aside');
  get_footer();
?>
