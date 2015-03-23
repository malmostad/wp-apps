<?php
$mconfig['env'] = ENV;
$mconfig['logdir'] = dirname(__FILE__) . '/../../../';

if ($mconfig['env'] == 'development') {
  $mconfig['loglevel'] = 3;
}
elseif ($mconfig['env'] == 'test' ) {
  $mconfig['loglevel'] = 2;
  $mconfig['cache_engine'] = 'apc';
}
else {
  $mconfig['loglevel'] = 1;
  $mconfig['cache_engine'] = 'apc';
}

$mconfig['eri_cats'] = false;
