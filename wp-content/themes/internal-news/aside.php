<!--eri-no-index-->
<aside role="complementary">
  <nav class="basic">
    <h1>Nyheter</h1>
    <ul>
      <?php if (is_user_logged_in()): ?>
        <li><a href="<?php bloginfo("url")?>/wp-admin/post-new.php">Skapa en nyhet</a></li>
        <li><a rel="nofollow" href="<?php echo wp_logout_url(); ?>">Logga ut</a></li>
      <?php else: ?>
        <li><a href="<?php echo wp_login_url($_SERVER['REQUEST_URI']) ?>">Logga in</a></li>
      <?php endif; ?>
      <li><a href="https://webapps09.malmo.se/wiki/Nyhetsguide_f%C3%B6r_Komin">Hjälp</a></li>
    </ul>

    <ul>
      <li><a href="<?php bloginfo('url'); ?>/">Alla nyheter</a></li>
      <li><a href="<?php bloginfo('url'); ?>/kategorier">Nyhetskategorier</a></li>
      <li><a href="<?php bloginfo('url'); ?>/etiketter">Nyhetsetiketter</a></li>
      <li><a href="<?php bloginfo('url'); ?>/arkiv">Nyhetsarkiv</a></li>
    </ul>
  </nav>

  <nav class="basic latest-posts">
    <h1><a href="<?php bloginfo("url")?>/target/var-kommun">Övergripande nyheter</a></h1>
    <ul>
      <?php
        global $template_vars;
        $post_id = empty($template_vars['postID']) ? null : $template_vars['postID'];
        $query = get_top_news($post_id);
        if ($query->have_posts()):
          while ($query->have_posts()): $query->the_post(); ?>
          <li>
            <a href="<?php echo get_permalink() ?>">
              <div class="featured-image">
                <?php if (has_post_thumbnail()):
                  the_post_thumbnail('thumbnail', array( 'alt' => ''));
                  else: ?>
                  <img src="<?php global $mconfig; echo $mconfig['asset_host'] . 'placeholder.png' ?>" alt="" />
                <?php endif; ?>
              </div>
              <div class="text">
                <h2><?php the_title() ?></h2>
                <time><?php echo get_the_date() . ' ' .  get_the_time() ?></time>
                <p><?php echo preamble(get_the_id(), 10) ?></p>
              </div>
            </a>
          </li>
        <?php endwhile ?>
      <?php endif ?>
    </ul>
  </nav>
</aside>
<!--/eri-no-index-->
