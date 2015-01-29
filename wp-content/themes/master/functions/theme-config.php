<?php

$mconfig['env'] = ENV;
$mconfig['logdir'] = dirname(__FILE__) . '/../../../';

$mconfig['staff_directory'] = 'http://webapps06.malmo.se/dashboard/users/';
$mconfig['avtar_base_url'] =  '//webapps06.malmo.se/avatars/';

if ($mconfig['env'] == 'development') {
  $mconfig['asset_host'] = '//assets.malmo.se/external/v4-staging/';
  $mconfig['loglevel'] = 3;
}
elseif ($mconfig['env'] == 'test' ) {
  $mconfig['asset_host'] = '//assets.malmo.se/external/v4-staging/';
  $mconfig['loglevel'] = 2;
  $mconfig['cache_engine'] = 'apc';
}
else {
  $mconfig['asset_host'] = '//assets.malmo.se/external/v4/';
  $mconfig['loglevel'] = 1;
  $mconfig['cache_engine'] = 'apc';
}

$mconfig['cache_id'] = 'external_blog_' . $mconfig['env'];
$mconfig['eri_cats'] = false;
