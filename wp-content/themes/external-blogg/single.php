<?php get_header(); ?>
<main role="main" class="post">
  <?php while (have_posts()): the_post(); ?>
    <h1 class="body-copy"><?php the_title(); ?></h1>

    <section class="meta">
      <div class="author">
        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )) ?>">
          <?php echo get_avatar(get_the_author_meta('user_email'), 130) ; ?>
          <div class="vcard fn"><?php the_author() ?></div>
        </a>
      </div>
      <time><?php echo get_the_date() . ' ' . get_the_time() ?></time>

      <?php get_template_part('single-meta') ?>

      <section class="share">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(the_guid()) ?>" title="Dela sidan på Facebook"><span class="fa fa-facebook-square"></span></a>
        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()) ?>&amp;url=<?php echo urlencode(the_guid()) ?>" title="Twittra om sidan"><span class="fa fa-twitter-square"></span></a>
        <a href="https://plus.google.com/share?url=<?php echo urlencode(the_guid()) ?>" title="Dela sidan på Google+"><span class="fa fa-google-plus-square"></span></a>
      </section>

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
        <?php if ( has_post_thumbnail() ) { ?>
          <div class="featured-image">
            <?php the_post_thumbnail('medium', array('class' => 'article-image')) ?>
          </div>
          <?php }
            the_content();
            $postID = $post->ID;
            if (is_user_logged_in()):
          ?>
        <?php endif; ?>

        <?php get_template_part('single-meta') ?>
      </article>
      <?php comments_template( '', true ); ?>
    </div>
  <?php endwhile; ?>


  <nav>
    <ul class="pagination">
      <li class="previous"><?php previous_post_link( '%link', '%title' ); ?></li>
      <li class="next"><?php next_post_link( '%link', '%title' ); ?></li>
    </ul>
  </nav>
</main>

<?php
  $template_vars = array('postID' => $postID);
  get_template_part('aside');
  get_footer();
?>
