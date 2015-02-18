<?php
  global $template_vars, $mconfig;
  $title = isset($template_vars['title']) ? $template_vars['title'] : "Alla Kominnyheter";
  $feed_url = isset($template_vars['feed_url']) ? $template_vars['feed_url'] : "./feed";
  $alt = isset($alt) ? $alt : "Prenumerera på RSS-flödet för {$title}";
?>
<main role="main" class="loop">
  <h1 class="page-title"><?php echo $title ?></h1>

  <?php if (have_posts()): ?>
    <?php while (have_posts()): the_post(); ?>
      <section id="post-<?php the_ID(); ?>" <?php post_class() ?>>
        <?php get_template_part('loop-meta') ?>

        <a href="<?php the_permalink(); ?>" rel="bookmark">
          <section class="body-copy">
            <h1><?php the_title(); ?></h1>
            <p class="published">Publicerad <?php the_author() ?> av <?php echo get_the_date() . ' ' . get_the_time() ?></p>
            <p><?php echo preamble(get_the_id(), 100) ?></p>
            <p class="comments-link"><?php comments_number('Kommentera', 'En kommentar', '% kommentarer') ?></p>
          </section>
        </a>
      </section>
    <?php endwhile ?>
  <?php endif ?>

  <a class="feed" href="<?php echo $feed_url ?>">
    <img src="<?php echo get_template_directory_uri() . '/images/feed-18.png' ?>" alt="<?php echo $alt ?>" title="<?php echo $alt ?>" />
  </a>
  <?php get_template_part('nav-posts') ?>
</main>
