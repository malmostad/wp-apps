<div class="author">
  <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )) ?>">
    <?php echo get_avatar(get_the_author_meta('user_email'), 139) ; ?>
    <div class="vcard fn"><?php the_author() ?></div>
  </a>
</div>
<time><?php echo get_the_date() . ' ' .  get_the_time() ?></time>
