function disable_admin_menus() {
  // remove_menu_page('themes.php');
  remove_submenu_page('themes.php', 'themes.php');
  remove_submenu_page(
    'themes.php',
    'customize.php?return='.urlencode($_SERVER['REQUEST_URI'])
  );
  remove_submenu_page('themes.php', 'theme-editor.php');
  remove_submenu_page('tools.php', 'tools.php');
  remove_submenu_page('tools.php', 'import.php');
  remove_submenu_page('tools.php', 'export.php');
}
add_action('admin_init', 'disable_admin_menus', 102);
