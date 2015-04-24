function remove_menu_containers($args=''){
  $args['container'] = false;
  return $args;
}
add_filter('wp_nav_menu_args', 'remove_menu_containers');

// Turns this:
wp_nav_menu(array(
  'theme_location' => 'menu_primary',
  'container' => false, // No longer necessary
));

// Into this:
wp_nav_menu(array(
  'theme_location' => 'menu_primary',
));
