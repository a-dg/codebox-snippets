/**
 * Register menus
 */
add_theme_support('menus');
define('MENU_PRIMARY', 'menu_primary');
define('MENU_SECONDARY', 'menu_secondary');
define('MENU_TERTIARY', 'menu_tertiary');
function app_menus() {
  $locations = array(
    MENU_PRIMARY    => __('Primary'),
    MENU_SECONDARY  => __('Secondary'),
    MENU_TERTIARY   => __('Tertiary'),
  );
  register_nav_menus($locations);
}
add_action('init', 'app_menus');

// Usage
wp_nav_menu(array('theme_location'=>'menu_secondary', 'container'=>false));
