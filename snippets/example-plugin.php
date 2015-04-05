/*
Plugin Name: Example Plugin
Description: Description goes here
Version: 1.0
Author: Vermilion
*/

$plugin_name = 'Example Plugin';
$plugin_slug = Str::machine($plugin_name, '-');

add_action('admin_menu', 'add_menu_item');
function add_menu_item() {
  global $plugin_name;
  add_management_page(
    $plugin_name,
    $plugin_name,
    'manage_options',
    $plugin_slug,
    'plugin_core'
  );
}

function plugin_core() {
  if(!current_user_can('manage_options')) {
    wp_die('You do not have sufficient permissions to access this page.');
  }
  
  global $plugin_name;
  global $plugin_slug;
  
  // // JS
  // wp_deregister_script($plugin_slug);
  // wp_register_script($plugin_slug, sprintf('%s/%s/%s.js', WP_PLUGIN_URL, $plugin_slug, $plugin_slug), false, THEME_VERSION, true);
  // wp_enqueue_script($plugin_slug);
  
  // // CSS
  // wp_deregister_style($plugin_slug);
  // wp_register_style($plugin_slug, sprintf('%s/%s/%s.css', WP_PLUGIN_URL, $plugin_slug, $plugin_slug));
  // wp_enqueue_style($plugin_slug);
  
  // Any old PHP goes here
  echo '<h1>'.$plugin_name.'</h1>';
}
