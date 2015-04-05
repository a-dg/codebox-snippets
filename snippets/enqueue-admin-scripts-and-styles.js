if(is_admin()) {
  add_action('admin_enqueue_scripts', 'app_admin_enqueue_style', 10);
  add_action('admin_enqueue_scripts', 'app_admin_enqueue_script', 1);
}
function app_admin_enqueue_style() {
  // List CSS
  $styles = array(
    // 'admin' => 'css/admin.css',
    'jquery-ui' => 'lib/jquery-ui/jquery-ui.min.css',
    'jquery-ui-structure' => 'lib/jquery-ui/jquery-ui.structure.min.css',
    'jquery-ui-theme' => 'lib/jquery-ui/jquery-ui.theme.min.css',
  );
  foreach($styles as $k=>$style) {
    wp_register_style($k, get_template_directory_uri().'/'.$style, false, THEME_VERSION);
    wp_enqueue_style($k);
  }
}
function app_admin_enqueue_script() {
  // List JS
  $scripts = array(
    'jquery-ui' => 'lib/jquery-ui/jquery-ui.min.js',
    'datepicker' => 'lib/jquery-ui/datepicker.js',
  );
  foreach($scripts as $k=>$script) {
    wp_deregister_script($k);
    wp_register_script($k, get_template_directory_uri().'/'.$script, false, THEME_VERSION, true);
    wp_enqueue_script($k);
  }
}