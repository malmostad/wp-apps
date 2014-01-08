<?php

$mconfig['env'] = ENV;
$mconfig['logdir'] = dirname(__FILE__) . '/../../../';

if ( $mconfig['env'] == 'development') {
  $mconfig['asset_host'] =  '//www.local.malmo.se:3001/assets/';
  $mconfig['loglevel'] = 3;
  $mconfig['cache_engine'] = 'apc';
}
elseif ( $mconfig['env'] == 'test' ) {
  $mconfig['asset_host'] = '//assets.malmo.se/interanl/3.0-staging/';
  $mconfig['loglevel'] = 2;
  $mconfig['cache_engine'] = 'apc';
}
else {
  $mconfig['asset_host'] = '//assets.malmo.se/internal/3.0/';
  $mconfig['loglevel'] = 1;
  $mconfig['cache_engine'] = 'apc';
}

$mconfig['cache_id'] = 'hr_' . $mconfig['env'];
$mconfig['eri_cats'] = false;
