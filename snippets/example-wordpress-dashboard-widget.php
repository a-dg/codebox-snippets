function documentation_widget() {
  echo '<p>Consult the <a href="/docs/">documentation for this managing site</a>.</p>';
}
function add_documentation_widget() {
  wp_add_dashboard_widget('documentation_widget', 'Documentation', 'documentation_widget');
}
add_action('wp_dashboard_setup', 'add_documentation_widget');
