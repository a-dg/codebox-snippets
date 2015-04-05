function remove_empty_title_attributes($attr) {
  if($attr['title'] == '') {
    unset($attr['title']);
  }
  return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'remove_empty_title_attributes');
