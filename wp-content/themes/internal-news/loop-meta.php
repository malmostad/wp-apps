<?php global $mconfig ?>

<div class="entry-meta">
  <div class="article-image">
    <?php if (has_post_thumbnail()):
      the_post_thumbnail('thumbnail', array( 'alt' => ''));
      else: ?>
      <img src="<?php echo $mconfig['asset_host'] . 'placeholder.png' ?>" alt="" />
    <?php endif; ?>
  </div>
</div>
