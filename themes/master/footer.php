</div>
<?php
  global $page, $paged, $mconfig;
  log_db_queries();
  wp_footer();
?>
<script src="<?php echo $mconfig['asset_host'] ?>malmo.js" ></script>
<script src="<?php echo get_template_directory_uri() ?>/javascripts/application.js"></script>
</body>
</html>
