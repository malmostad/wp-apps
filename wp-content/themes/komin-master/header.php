<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title><?php
  global $page, $paged, $mconfig;

  // Description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) echo "$site_description - ";
  wp_title( '-', true, 'right' );
  bloginfo( 'name' );

?></title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
<?php if ( is_single() ) {
  // Meta tags for main categories fetched by Siteseeker
  foreach( (get_the_category() ) as $term ) {
    if ($term->parent == 0) {
      echo "<meta name='eri-cat' content='$term->name'/>\n";
    }
  }
}
?>
<!--[if lte IE 8]><script src="<?php echo $mconfig['asset_host'] ?>html5shiv-printshiv.js" type="text/javascript"></script><![endif]-->
<link href="<?php echo $mconfig['asset_host'] ?>malmo.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/stylesheets/application.css"/>
<!--[if lte IE 7]><link href="<?php echo $mconfig['asset_host'] ?>legacy/ie7.css" rel="stylesheet" type="text/css"/><![endif]-->
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"/><![endif]-->
<script>var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";</script>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>s flöde" href="<?php bloginfo('url'); ?>/mainfeed/"/>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>s kommentarsflöde" href="<?php bloginfo('url'); ?>/comments/feed/"/>
<?php
  if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
  wp_head();
?>
</head>
<body <?php body_class($mconfig['env'] . " malmo-masthead-more malmo-form"); ?>>
<!--eri-no-index-->
<div class="service-title"><a href="<?php bloginfo('url'); ?>"><?php _e('Tjänstenamn', 'malmo') ?></a></div>
<!--/eri-no-index-->
<div class="wrapper">
