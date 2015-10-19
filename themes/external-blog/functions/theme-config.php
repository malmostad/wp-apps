<?php
$mconfig['env'] = ENV;
$mconfig['logdir'] = dirname(__FILE__) . '/../../../';

if ($mconfig['env'] == 'development') {
  $mconfig['asset_host'] = '//assets.malmo.se/external/v4-staging/';
}
elseif ($mconfig['env'] == 'test' ) {
  $mconfig['asset_host'] = '//assets.malmo.se/external/v4-staging/';
}
else {
  $mconfig['asset_host'] = '//assets.malmo.se/external/v4/';
}

$mconfig['cache_id'] = 'external_blog_' . $mconfig['env'];
$mconfig['eri_cats'] = false;
