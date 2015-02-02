<?php global $mconfig ?>

<div class="author">
  <a href="<?php echo $mconfig['staff_directory'] . get_the_author_meta('user_login') ?>">
    <?php echo get_avatar(get_the_author_meta('user_email'), 139) ; ?>
    <div class="vcard fn"><?php the_author() ?></div>
  </a>
</div>
