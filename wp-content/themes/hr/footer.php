</div>
<?php
  global $page, $paged, $mconfig;
  get_sidebar( 'footer' );
  log_db_queries();
  wp_footer();
?>
<script src="<?php bloginfo( 'template_directory' ); ?>/javascripts/application.js"></script>
</body>
</html>