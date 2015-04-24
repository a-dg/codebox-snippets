function add_admin_menu_separator() {
  global $menu;
  // Insert in place of comments
  $menu[25] = array(
    0 => '',
    1 => 'read',
    2 => 'separator25',
    3 => '',
    4 => 'wp-menu-separator'
  );
}
add_action('admin_init', 'add_admin_menu_separator');
