function add_slug_to_menu_item_class($menu_html) {
  // Get menu item IDs and link slugs
  preg_match_all('/menu-item-(\d+).*href="(?:(?:.*?)\/\/(?:.*?))?\/(.*?)\/?"/', $menu_html, $matches);
  
  // Combine match groups into array
  $menu_items = array_combine($matches[1], $matches[2]);
  
  // Strip slugs down to last segment
  $menu_items = array_map(function($el){
    $slash_index = strrpos($el, '/');
    return ($slash_index)
      ? substr($el, $slash_index + 1)
      : $el;
  }, $menu_items);
  
  // Search/replace
  foreach($menu_items as $menu_item_id => $link_slug){
    $menu_html = preg_replace('/menu-item-'.$menu_item_id.'">/', 'menu-item-'.$menu_item_id.' menu-item-'.$link_slug.'">', $menu_html, 1);
  }
  return $menu_html;
}
add_filter('wp_nav_menu', 'add_slug_to_menu_item_class');