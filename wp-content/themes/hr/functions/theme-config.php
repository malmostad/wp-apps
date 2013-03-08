<?php

$mconfig['env'] = ENV;
$mconfig['logdir'] = dirname(__FILE__) . '/../../../';

if ( $mconfig['env'] == 'development') {
  $mconfig['asset_host'] =  '//www.local.malmo.se:3001/assets/';
  $mconfig['asset_host_stylesheet'] =  '//www.local.malmo.se:3001/assets/malmo.css';
  $mconfig['loglevel'] = 3;
  $mconfig['cache_engine'] = 'apc';
}
elseif ( $mconfig['env'] == 'test' ) {
  $mconfig['asset_host'] = '//webapps06.malmo.se/assets-3.0-test/';
  $mconfig['asset_host_stylesheet'] =  '//webapps06.malmo.se/assets-3.0-test/malmo.css';
  $mconfig['loglevel'] = 2;
  $mconfig['cache_engine'] = 'apc';
}
else {
  $mconfig['asset_host'] = '//webapps06.malmo.se/assets-3.0/';
  $mconfig['asset_host_stylesheet'] =  '//webapps06.malmo.se/assets-3.0/malmo.css';
  $mconfig['loglevel'] = 1;
  $mconfig['cache_engine'] = 'apc';
}
$mconfig['cache_id'] = 'hr_' . $mconfig['env'];
