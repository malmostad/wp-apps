<?php get_header(); ?>
<div role="main" class="post">
  <?php while (have_posts()): the_post(); ?>
    <div class="body-copy">
      <h1><?php the_title(); ?></h1>
    </div>

    <section class="meta">
      <div class="author-avatar">
        <div class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )) ?>" id="blogger-menu" role="button" title="Information om bloggaren">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), 139) ; ?>
            <p class="author vcard"><?php the_author() ?></p>
          </a>
          <menu aria-labelledby="blogger-menu" class="dropdown-menu" role="menu">
            <li><a href="<?php echo $mconfig['staff_directory'] . get_the_author_meta('user_login') ?>">Kontaktkort</a></li>
            <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )) ?>">Alla inlägg</a></li>
          </menu>
        </div>
      </div>
      <time pubdate><?php echo get_the_date() . ' ' . get_the_time() ?></time>
      <dl class="entry-meta">
        <dt class="meta-prep meta-prep-tags">Kategorier:</dt>
        <dd>
          <ul>
            <?php $terms = get_the_category(); ?>
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
      <script>
        var blogTracking = {
          author: "<?php the_author() ?>",
          categories: [ <?php foreach((get_the_category()) as $category) { echo '"' . htmlspecialchars_decode($category->cat_name) . '",'; } ?> ]
        };
      </script>
      <div <?php if (GetVotes(get_the_ID())) { echo 'data-vote="' . get_the_ID() . '" class="vote-box"'; } ?>>
        <?php DisplayVotes(get_the_ID()); ?>
      </div>
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
        <a class="btn btn-mini edit" href="<?php echo get_edit_post_link() ?>">Redigera</a>
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
</div>

<?php
  $template_vars = array('postID' => $postID);
  get_footer();
?>
