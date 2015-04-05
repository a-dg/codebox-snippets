function override_wp_search_result_count($query) {
  if($query->is_search) {
    $query->query_vars['posts_per_page'] = 50;
  }
  return $query;
}
add_filter('pre_get_posts', 'override_wp_search_result_count');
