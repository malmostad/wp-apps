<!--eri-no-index-->
<aside role="complementary">
  <h1><a href="<?php bloginfo("url")?>">Senaste inläggen</a></h1>
  <ul class="latest-post">
    <?php
      global $template_vars;
      $query = get_top_posts($template_vars['postID']);
      if ($query->have_posts()):
        while ($query->have_posts()): $query->the_post(); ?>
        <li>
          <a href="<?php echo get_permalink() ?>">
            <div class="featured-image">
              <?php echo get_avatar( get_the_author_meta( 'user_email' ), 48); ?>
            </div>
            <h2><?php the_title() ?></h2>
            <p>
              <time><?php echo get_the_date() . ' ' .  get_the_time() ?></time>
              <?php echo truncate_excerpt(get_the_content(), 20) ?>
            </p>
          </a>
        </li>
      <?php endwhile ?>
    <?php endif ?>
  </ul>
</aside>
<!--/eri-no-index-->
