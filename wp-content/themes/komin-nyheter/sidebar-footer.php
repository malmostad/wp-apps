<?php global $mconfig; ?>
<!--eri-no-index-->
<footer class="bigfoot">
  <nav>
    <ul class="list-1">
      <li><a href="<?php bloginfo('url'); ?>/">Alla nyheter</a></li>
      <li><a href="<?php bloginfo('url'); ?>/kategorier">Nyhetskategorier</a></li>
      <li><a href="<?php bloginfo('url'); ?>/etiketter">Nyhetsetiketter</a></li>
      <li><a href="<?php bloginfo('url'); ?>/arkiv">Nyhetsarkiv</a></li>
    </ul>
    <ul class="list-2">
      <?php if (!is_user_logged_in()): ?>
        <li><a href="<?php echo wp_login_url($_SERVER['REQUEST_URI']) ?>">Logga in</a></li>
      <?php else: ?>
        <li><a rel="nofollow" href="<?php echo wp_logout_url($mconfig['logout_redirect_url']); ?>">Logga ut</a></li>
      <?php endif; ?>
      <li><a href="<?php bloginfo("url")?>/wp-admin/post-new.php">Skapa en nyhet</a></li>
    </ul>
    <ul class="list-3">
      <li><a href="<?php bloginfo('url'); ?>/hjalp">Instruktioner &amp; hjälp</a></li>
    </ul>
  </nav>
</footer>
<!--/eri-no-index-->