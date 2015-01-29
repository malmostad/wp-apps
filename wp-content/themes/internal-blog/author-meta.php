<div class="author">
  <div class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )) ?>" id="blogger-menu" role="button" title="Information om bloggaren">
      <?php echo get_avatar(get_the_author_meta('user_email'), 139) ; ?>
      <div class="vcard fn"><?php the_author() ?></div>
    </a>
    <menu aria-labelledby="blogger-menu" class="dropdown-menu" role="menu">
      <li><a href="<?php echo $mconfig['staff_directory'] . get_the_author_meta('user_login') ?>">Kontaktkort</a></li>
      <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )) ?>">Alla inlägg</a></li>
    </menu>
  </div>
</div>
