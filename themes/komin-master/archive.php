<?php
  // Default template for displaying Archive pages.
  get_header();
  if (single_cat_title('', false)):
    $title = single_cat_title('', false);
  elseif ( is_day() ):
    $title = "Dagsarkiv: " . get_the_date();
  elseif ( is_month() ):
  	$title = "Månadsarkiv: " . get_the_date('F Y');
  elseif ( is_year() ):
	 $title = "Årsarkiv: " . get_the_date('Y');
  else:
	 $title = "Arkiv";
  endif;
?>
<?php 
	rewind_posts();
  $template_vars = array('title' => $title);
  get_template_part('loop');
  get_template_part('aside');
  get_footer(); 
?>
