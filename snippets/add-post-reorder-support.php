function add_post_reorder_support() {
  add_post_type_support('post', 'page-attributes');
}
add_action('admin_init', 'add_post_reorder_support');
