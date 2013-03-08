<?php 
function malmo_widgets_init() {
  register_sidebar( array(
    'name' => 'Sidofält',
    'id' => 'primary-widget-area',
    'description' => 'Du kan lägga till fler widgets i denna yta',
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
}
add_action( 'widgets_init', 'malmo_widgets_init' );
