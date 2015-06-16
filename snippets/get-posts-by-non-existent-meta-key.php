// Taco
$posts = PostType::getBy('meta_key', '', 'NOT EXISTS');

// Standard meta query
$meta_query = array();
if(!is_null($include_featured)) {
  $compare = ($include_featured) ? '=' : 'NOT EXISTS';
  $meta_query['meta_query'] = array(
    array(
      'key' => 'is_featured',
      'value' => 1,
      'compare' => $compare
    )
  );
}
