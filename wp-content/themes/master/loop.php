<?php
  global $template_vars, $mconfig;
  $title = isset($template_vars['title']) ? $template_vars['title'] : "Alla inlägg";
  $feed_url = isset($template_vars['feed_url']) ? $template_vars['feed_url'] : "./feed";
  $alt = isset($alt) ? $alt : "Prenumerera på RSS-flödet för {$title}";
?>
<main role="main" class="loop">
  <?php if (!is_home()): ?>
    <h1 class="page-title"><?php echo $title ?></h1>
  <?php endif ?>

  <?php if (have_posts()): ?>
    <?php while (have_posts()): the_post(); ?>
      <section id="post-<?php the_ID(); ?>" <?php post_class() ?>>
        <div class="entry-meta">
          <?php get_template_part('author-meta') ?>
          <time><?php echo get_the_date() . ' ' .  get_the_time() ?></time>
        </div>

        <a href="<?php the_permalink(); ?>" rel="bookmark">
          <section class="body-copy">
            <h1><?php the_title(); ?></h1>
            <p><?php echo truncate_excerpt(get_the_content(), 40) ?></p>
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
