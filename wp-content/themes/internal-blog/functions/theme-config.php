<?php

$mconfig['staff_directory'] = 'http://webapps06.malmo.se/dashboard/users/';
$mconfig['avtar_base_url'] =  '//webapps06.malmo.se/avatars/';

if ($mconfig['env'] == 'development') {
  $mconfig['asset_host'] = '//assets.malmo.se/internal/v4-staging/';
}
elseif ($mconfig['env'] == 'test' ) {
  $mconfig['asset_host'] = '//assets.malmo.se/internal/v4-staging/';
}
else {
  $mconfig['asset_host'] = '//assets.malmo.se/internal/v4/';
}

$mconfig['cache_id'] = 'internal_blog_' . $mconfig['env'];
$mconfig['eri_cats'] = false;
