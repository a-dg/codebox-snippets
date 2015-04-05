function remove_domain_from_menu_item_links($menu_html) {
  $protocol = (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443
  ) ? 'https://' : 'http://';
  $domain_name = $_SERVER['HTTP_HOST'];
  
  return str_replace($protocol.$domain_name, '', $menu_html);
}
add_filter('wp_nav_menu', 'remove_domain_from_menu_item_links');
