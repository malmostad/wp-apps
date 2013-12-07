<!--eri-no-index-->
<aside role="complementary">
  <?php if (is_home() && is_active_sidebar('home-page-widget-area')): ?>
    <div class="widget-area">
      <?php dynamic_sidebar('home-page-widget-area') ?>
    </div>
  <?php endif ?>

  <?php if (!is_home()): ?>
    <h1><a href="<?php bloginfo("url")?>">Malmö stad bloggar</a></h1>
    <ul class="latest-post">
      <?php
        global $template_vars;
        $query = get_top_posts($template_vars['postID']);
        if ($query->have_posts()):
          while ($query->have_posts()): $query->the_post(); ?>
          <li>
            <a href="<?php echo get_permalink() ?>">
              <div class="featured-image">
                <?php echo get_avatar(get_the_author_meta('user_email'), 48) ?>
              </div>
              <h2><?php the_title() ?></h2>
              <time><?php echo get_the_date() . ' ' .  get_the_time() ?></time>
            </a>
          </li>
        <?php endwhile ?>
      <?php endif ?>
    </ul>
  <?php endif ?>

  <nav>
    <ul>
      <li><a href="<?php bloginfo('url'); ?>/">Alla inlägg</a></li>
      <li><a href="<?php bloginfo('url'); ?>/bloggare">Bloggare</a></li>
      <li><a href="<?php bloginfo('url'); ?>/kategorier">Kategorier</a></li>
      <li><a href="<?php bloginfo('url'); ?>/etiketter">Etiketter</a></li>
      <li><a href="<?php bloginfo('url'); ?>/arkiv">Arkiv</a></li>
    </ul>
  </nav>

</aside>
<!--/eri-no-index-->
