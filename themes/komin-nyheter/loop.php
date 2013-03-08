<?php
  global $template_vars;
  $title = isset($template_vars['title']) ? $template_vars['title'] : "Alla Kominnyheter";
  $feed_url = isset($template_vars['feed_url']) ? $template_vars['feed_url'] : "./feed";
  $alt = isset($alt) ? $alt : "Prenumerera på RSS-flödet för {$title}";
?>
<section class="loop" role="main">
  <h1 class="page-title"><?php echo $title ?></h1>

  <?php if (have_posts()) : ?>
    <?php  while (have_posts()): the_post(); ?>

      <a class="post" href="<?php the_permalink(); ?>" rel="bookmark">
        <section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="article-image">
            <?php if (has_post_thumbnail()):
              the_post_thumbnail('thumbnail', array( 'alt' => ''));
              else: ?>
              <img src="<?php global $mconfig; echo $mconfig['asset_host'] . 'placeholder.png' ?>" alt="" />
            <?php endif; ?>
          </div>

          <div class="text">
            <h1><?php the_title(); ?></h1>
            <p class="entry-meta">
              Publicerad <time><?php echo get_the_date() . ' ' .  get_the_time() ?></time> av
              <span class="author vcard"><?php the_author() ?></span>
            </p>
            <p class="entry-summary"><?php echo preamble(get_the_id(), 100) ?></p>
            <p class="comments-link"><?php comments_number('Kommentera', 'En kommentar', '% kommentarer') ?></p>
          </div>
        </section>
      </a>
    <?php endwhile ?>
  <?php endif ?>

  <a class="feed" href="<?php echo $feed_url ?>">
    <img src="<?php echo get_template_directory_uri() . '/images/feed-18.png' ?>" alt="<?php echo $alt ?>" title="<?php echo $alt ?>" />
  </a>
  <?php get_template_part('nav-posts') ?>
</section>
