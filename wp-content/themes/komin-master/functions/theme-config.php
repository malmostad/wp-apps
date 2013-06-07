<?php

$mconfig['env'] = ENV;

$mconfig['logdir'] = dirname(__FILE__) . '/../../../';

if ( $mconfig['env'] == 'development') {

  $mconfig['logout_redirect_url'] =  'https://webapps06.malmo.se/dashboard/logout';
  $mconfig['avtar_base_url'] =  '//www.local.malmo.se/ws/avatars/';
  $mconfig['asset_host'] =  '//www.local.malmo.se:3001/assets/';
  $mconfig['loglevel'] = 3;
}
elseif ( $mconfig['env'] == 'test' ) {
  $mconfig['logout_redirect_url'] =  'https://webapps06.malmo.se/dashboard-test/logout';
  $mconfig['avtar_base_url'] =  '//webapps06.malmo.se/avatars/';
  $mconfig['asset_host'] = '//assets.malmo.se/internal/3.0-staging/';
  $mconfig['loglevel'] = 2;
  $mconfig['cache_engine'] = 'apc';
}
else {
  $mconfig['logout_redirect_url'] =  'https://webapps06.malmo.se/dashboard/logout';
  $mconfig['avtar_base_url'] =  '//webapps06.malmo.se/avatars/';
  $mconfig['asset_host'] = '//assets.malmo.se/internal/3.0/';
  $mconfig['loglevel'] = 1;
  $mconfig['cache_engine'] = 'apc';
}
$mconfig['cache_id'] = 'news_' . $mconfig['env'];
