/**
 * Remove domain name from URL
 * @param string $url
 * @return string
 */
function remove_domain_name($url) {
  return str_replace(URL_BASE, '', $url);
}

/**
 * Get theme directory URL without domain name
 * @return string
 */
function get_app_dir() {
  return remove_domain_name(get_template_directory_uri());
}

/**
 * Get the asset path with theme version number
 * @param string $relative_path
 * @return string
 */
function get_asset_path($relative_path) {
  $use_underscore_assets_directory = false;
  $clean_relative_path = preg_replace('/^[_\/]+/', '', $relative_path);
  return sprintf(
    '%s/%s%s%s',
    get_app_dir(),
    ($use_underscore_assets_directory) ? '_/' : null,
    $clean_relative_path,
    THEME_SUFFIX
  );
}

// Usage
echo get_asset_path('img/partners/americorps.png');