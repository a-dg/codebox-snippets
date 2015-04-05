/**
 * Get the page title
 * @return string
 */
function app_get_page_title() {
  return join(' | ', array_map('trim', array_filter(array(wp_title(null, false), get_bloginfo('name')), 'strlen')));
}