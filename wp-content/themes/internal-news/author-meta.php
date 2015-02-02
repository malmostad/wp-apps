<?php global $mconfig ?>

<?php
/*
<div class="article-image">
  <?php if (has_post_thumbnail()):
    the_post_thumbnail('thumbnail', array( 'alt' => ''));
    else: ?>
    <img src="<?php echo $mconfig['asset_host'] . 'placeholder.png' ?>" alt="" />
  <?php endif; ?>
</div>
*/
?>
 
<div class="author">
  <a href="<?php echo $mconfig['staff_directory'] . get_the_author_meta('user_login') ?>">
    <?php echo get_avatar(get_the_author_meta('user_email'), 139) ; ?>
    <div class="vcard fn"><?php the_author() ?></div>
  </a>
</div>
