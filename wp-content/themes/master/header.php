<?php global $mconfig ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title><?php wp_title('-', true, 'right') ?></title>
<!-- <WA disable link> -->
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
<?php if (is_single() && $mconfig['eri_cats']) {
  // Meta tags for main categories fetched by Siteseeker
  foreach((get_the_category()) as $term) {
    if ($term->parent == 0) {
      echo "<meta name='eri-cat' content='$term->name'/>\n";
    }
  }
}
?>
<!--[if lte IE 8]><script src="<?php echo $mconfig['asset_host'] ?>html5shiv-printshiv.js" type="text/javascript"></script><![endif]-->
<link href="<?php echo $mconfig['asset_host'] ?>malmo.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" media="all" href="<?php echo get_template_directory_uri() ?>/stylesheets/application.css"/>
<!--[if lte IE 8]><link href="<?php echo $mconfig['asset_host'] ?>legacy/ie8.css" rel="stylesheet" type="text/css"/><![endif]-->
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"/><![endif]-->
<script>var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";</script>
<link rel="icon" type="image/x-icon" href="<?php echo $mconfig['asset_host'] ?>favicon.ico"/>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>s flöde" href="<?php bloginfo('url'); ?>/mainfeed/"/>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>s kommentarsflöde" href="<?php bloginfo('url'); ?>/comments/feed/"/>
<?php wp_head() ?>
<?php get_template_part('social-meta') ?>
</head>
<body <?php body_class($mconfig['env'] . " malmo-masthead-more mf-v4"); ?>>
<div class="wrapper">
<?php get_template_part('breadcrumbs') ?>
