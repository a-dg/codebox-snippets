function highlight_current_archive_link($link_html) {
  global $wp;
  static $current_url;
  if(empty($current_url)) {
    $current_url = add_query_arg($_SERVER['QUERY_STRING'], '', home_url($wp->request));
  }
  if(stristr($current_url, 'page') !== false) {
  $current_url = substr($current_url, 0, strrpos($current_url, 'page'));
  }
  if(stristr($link_html, $current_url) !== false) {
    $link_html = preg_replace('/(<[^\s>]+)/', '\1 class="current-archive"', $link_html, 1);
  }
  return $link_html;
}
add_filter('get_archives_link', 'highlight_current_archive_link');
