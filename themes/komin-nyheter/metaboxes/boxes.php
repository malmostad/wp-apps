<?php

$mb_preamble = new WPAlchemy_MetaBox(
  array(
  	'id' => '_metabox_preamble',
  	'title' => 'Ingress',
  	'template' => get_stylesheet_directory() . '/metaboxes/templates/preamble.php',
    'types' => array('post'),
    'autosave' => true,
    'lock' => WPALCHEMY_LOCK_AFTER_POST_TITLE,
    'view' => WPALCHEMY_VIEW_ALWAYS_OPENED,
    'hide_screen_option' => true,
    'hide_title' => true,
  )
);

$mb_facts = new WPAlchemy_MetaBox(
  array(
    'id' => '_metabox_facts',
    'title' => 'Faktaruta',
    'template' => get_stylesheet_directory() . '/metaboxes/templates/facts.php',
    'types' => array('post'),
    'autosave' => true,
    'view' => WPALCHEMY_VIEW_ALWAYS_OPENED,
    'hide_screen_option' => true,
    'hide_title' => false,
  )
);

$mb_links = new WPAlchemy_MetaBox(
  array(
    'id' => '_metabox_links',
    'title' => 'Läs mer-länkar',
    'template' => get_stylesheet_directory() . '/metaboxes/templates/links.php',
    'types' => array('post'),
    'autosave' => true,
    'view' => WPALCHEMY_VIEW_ALWAYS_OPENED,
    'hide_screen_option' => true,
    'hide_title' => false,
  )
);

$mb_publishing_options = new WPAlchemy_MetaBox(
  array(
    'id' => '_metabox_publishing_options',
    'title' => 'Publiceringsstyrning',
    'template' => get_stylesheet_directory() . '/metaboxes/templates/publishing_options.php',
    'types' => array('post'),
    'autosave' => true,
    'view' => WPALCHEMY_VIEW_START_CLOSED,
    'hide_screen_option' => false,
    'hide_title' => false,
  )
);
