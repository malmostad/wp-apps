<!--eri-no-index-->
<aside role="complementary">
  <h1><a href="<?php bloginfo("url")?>/target/var-kommun">Övergripande nyheter</a></h1>
  <ul class="latest-post">
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
            <h2><?php the_title() ?></h2>
            <p>
              <time><?php echo get_the_date() . ' ' .  get_the_time() ?></time>
              <?php echo preamble(get_the_id(), 20) ?>
            </p>
          </a>
        </li>
      <?php endwhile ?>
    <?php endif ?>
  </ul>
</aside>
<!--/eri-no-index-->
