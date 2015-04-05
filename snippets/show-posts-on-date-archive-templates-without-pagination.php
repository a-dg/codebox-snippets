function disallow_pagination_on_date_archive($query) {
  if(
    !is_admin()
    && $query->is_date()
    && $query->is_main_query()
  ) {
    $query->set('posts_per_page', -1);
  }
}
add_action('pre_get_posts', 'disallow_pagination_on_date_archive');
