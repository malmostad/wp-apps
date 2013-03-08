<?php
  global $template_vars;
  $title = isset($template_vars['title']) ? $template_vars['title'] : "Alla inlägg";
  $feed_url = isset($template_vars['feed_url']) ? $template_vars['feed_url'] : "./feed";
  $alt = isset($alt) ? $alt : "Prenumerera på RSS-flödet för {$title}";
?>
<section class="loop" role="main">
  <h1 class="page-title"><?php echo $title ?></h1>

  <?php if (have_posts()) : ?>
    <?php  while (have_posts()): the_post(); ?>
      <section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )) ?>" class="entry-meta">
          <div class="avatar">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), 139); ?>
          </div>
          <p class="author vcard"><?php the_author() ?></p>
          <time><?php echo get_the_date() . ' ' .  get_the_time() ?></time>
        </a>

        <a href="<?php the_permalink(); ?>" rel="bookmark">
          <section class="text">
            <h1><?php the_title(); ?></h1>
            <p class="entry-summary"><?php echo truncate_excerpt(get_the_content(), 50) ?></p>
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
</section>
