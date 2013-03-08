<?php

$mconfig['env'] = ENV;

$mconfig['logdir'] = dirname(__FILE__) . '/../../../';

if ( $mconfig['env'] == 'development') {

  $mconfig['avtar_base_url'] =  '//www.local.malmo.se/ws/avatars/';
  $mconfig['asset_host'] =  '//www.local.malmo.se:3001/assets/';
  $mconfig['asset_host_stylesheet'] =  '//www.local.malmo.se:3001/assets/malmo.css';
  $mconfig['asset_host_javascript'] =  '//www.local.malmo.se:3001/assets/malmo.js';
  $mconfig['loglevel'] = 3;
}
elseif ( $mconfig['env'] == 'test' ) {
  $mconfig['avtar_base_url'] =  'http://webapps06.malmo.se/avatars/';
  $mconfig['asset_host'] = '//webapps06.malmo.se/assets-3.0-test/';
  $mconfig['asset_host_stylesheet'] = '//webapps06.malmo.se/assets-3.0-test/malmo.css';
  $mconfig['asset_host_javascript'] = '//webapps06.malmo.se/assets-3.0-test/malmo.js';
  $mconfig['loglevel'] = 2;
  $mconfig['cache_engine'] = 'apc';
}
else {
  $mconfig['avtar_base_url'] =  '//webapps06.malmo.se/avatars/';
  $mconfig['asset_host'] = '//webapps06.malmo.se/assets-3.0/';
  $mconfig['asset_host_stylesheet'] = '//webapps06.malmo.se/assets-3.0/malmo.css';
  $mconfig['asset_host_javascript'] = '//webapps06.malmo.se/assets-3.0/malmo.js';
  $mconfig['loglevel'] = 1;
  $mconfig['cache_engine'] = 'apc';
}
$mconfig['cache_id'] = 'news_' . $mconfig['env'];
