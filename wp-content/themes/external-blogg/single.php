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

      <ul class="entry-meta">
        <li>Kategorier</li>
        <?php $terms = get_the_category(); ?>
        <?php foreach( ($terms ) as $term ) { ?>
          <li>
            <a href="<?php echo bloginfo("url") . '/' . $term->taxonomy . '/' . $term->slug ?>"><?php echo $term->name ?></a><?php if ($term != end($terms)) { echo ","; }?>
          </li>
        <?php } ?>
      </ul>

      <ul class="entry-tags">
        <li>Etiketter</li>
        <?php echo get_the_tag_list('<li>',', </li><li>','</li>'); ?>
      </ul>

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

      <a class="btn btn-default btn-sm edit" href="<?php echo get_edit_post_link() ?>">Redigera</a>
    </section>

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

      <dl class="entry-meta">
        <dt class="meta-prep meta-prep-tags">Kategorier:</dt>
        <dd>
          <ul>
            <?php foreach( ($terms ) as $term ) { ?>
              <li>
                <a href="<?php echo bloginfo("url") . '/' . $term->taxonomy . '/' . $term->slug ?>"><?php echo $term->name ?></a><?php if ($term != end($terms)) { echo ","; }?>
              </li>
            <?php } ?>
          </ul>
        </dd>
      </dl>
      <dl class="entry-tags">
        <dt class="meta-prep meta-prep-tags">Etiketter:</dt>
        <dd><ul><?php echo get_the_tag_list('<li>',', </li><li>','</li>'); ?></ul></dd>
      </dl>
    </article>
  <?php endwhile; ?>

  <?php comments_template( '', true ); ?>
  <menu class="history" type="toolbar">
    <li class="previous"><?php previous_post_link( '%link', '<span class="icon-circle-arrow-left icon-large"></span><span class="title">%title</span>' ); ?></li>
    <li class="next"><?php next_post_link( '%link', '<span class="title">%title</span><span class=" icon-circle-arrow-right icon-large"></span>' ); ?></li>
  </menu>
</main>

<?php
  $template_vars = array('postID' => $postID);
  get_template_part('aside');
  get_footer();
?>
