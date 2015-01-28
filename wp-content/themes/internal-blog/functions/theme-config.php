<?php

$mconfig['env'] = ENV;
$mconfig['logdir'] = dirname(__FILE__) . '/../../../';

if ($mconfig['env'] == 'development') {
  // $mconfig['asset_host'] =  '//www.local.malmo.se:3001/assets/';
  $mconfig['asset_host'] = '//assets.malmo.se/internal/v4-staging/';
  // $mconfig['asset_host'] =  '//161.52.82.110:3001/assets/';
  $mconfig['loglevel'] = 3;
}
elseif ($mconfig['env'] == 'test' ) {
  $mconfig['asset_host'] = '//assets.malmo.se/external/v4-staging/';
  $mconfig['loglevel'] = 2;
  $mconfig['cache_engine'] = 'apc';
}
else {
  $mconfig['avtar_base_url'] =  '//webapps06.malmo.se/avatars/';
  $mconfig['asset_host'] = '//assets.malmo.se/external/v4/';
  $mconfig['loglevel'] = 1;
  $mconfig['cache_engine'] = 'apc';
}

$mconfig['cache_id'] = 'external_blog_' . $mconfig['env'];
$mconfig['eri_cats'] = false;
