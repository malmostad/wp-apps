<!--eri-no-index-->
<aside role="complementary">
  <nav class="basic ">
    <h1>Blogga</h1>
    <ul>
      <?php if (is_user_logged_in()): ?>
        <li><a href="<?php bloginfo("url")?>/wp-admin/post-new.php">Skapa ett blogginlägg</a></li>
        <li><a rel="nofollow" href="<?php echo wp_logout_url(); ?>">Logga ut</a></li>
      <?php else: ?>
        <li><a href="<?php echo wp_login_url($_SERVER['REQUEST_URI']) ?>">Logga in</a></li>
      <?php endif; ?>
      <li><a href="https://webapps09.malmo.se/wiki/Blogga_p%C3%A5_Komin">Hjälp</a></li>
    </ul>

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
