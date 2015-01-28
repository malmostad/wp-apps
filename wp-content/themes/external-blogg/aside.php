<!--eri-no-index-->
<aside role="complementary">
  <?php if (!is_home()): ?>
    <nav class="basic latest-posts">
      <h1><a href="<?php bloginfo("url")?>">Senaste inläggen</a></h1>
      <ul>
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
                <div class="text">
                  <h2><?php the_title() ?></h2>
                  <time><?php echo get_the_date() . ' ' .  get_the_time() ?></time>
                </div>
              </a>
            </li>
          <?php endwhile ?>
        <?php endif ?>
      </ul>
    </nav>
  <?php endif ?>

  <nav class="basic">
    <h1>Här hittar du</h1>
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
