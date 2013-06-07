<!DOCTYPE html>
<html <?php language_attributes(); ?> id="html">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta content='IE=edge' http-equiv='X-UA-Compatible'/>
<title><?php
  global $page, $paged, $mconfig;

  // Description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) echo "$site_description - ";
  wp_title( '-', true, 'right' );
  bloginfo( 'name' );
?></title>
<!--[if lte IE 8]><script src="<?php echo $mconfig['asset_host'] ?>html5shiv-printshiv.js" type="text/javascript"></script><![endif]-->
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"/><![endif]-->
<?php
  if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
  wp_head();
?>
<link href="<?php echo $mconfig['asset_host'] ?>malmo.css" rel="stylesheet" type="text/css"/>
<link href="<?php bloginfo( 'stylesheet_directory' ); ?>/stylesheets/application.css" rel="stylesheet" type="text/css"/>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>s flöde" href="<?php bloginfo('url'); ?>/feed/"/>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>s kommentarsflöde" href="<?php bloginfo('url'); ?>/comments/feed/"/>
</head>
<body <?php body_class($mconfig['env'] . "malmo-form"); ?>>
<div class="wrapper">