// In wp-config.php:
define('SAVEQUERIES', true); // Disable on production

// In footer.php:
if(current_user_can('manage_options')) {
  global $wpdb;
  echo '<pre>queries: ';
  print_r($wpdb->queries);
  echo '</pre>';
}
