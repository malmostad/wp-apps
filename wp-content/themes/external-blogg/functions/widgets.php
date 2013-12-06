<?php
function malmo_child_widgets_init() {
  register_sidebar(array(
    'name' => 'Sidofält (startsidan)',
    'id' => 'home-page-widget-area',
    'description' => 'Sidofält för startsidan',
    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>',
  ));
}
add_action('widgets_init', 'malmo_child_widgets_init');
