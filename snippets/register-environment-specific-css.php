/**
 * Register the CSS
 */
function app_get_css() {
  $app_css = (ENVIRONMENT === ENVIRONMENT_PROD)
    ? 'css/app.css'
    : 'css/app-dev.css';
  return array(
    'all'=>array(
      'foundation' => 'lib/foundation/css/foundation.css',
      'app' => $app_css
    )
  );
}
