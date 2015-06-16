// Maybe this in a post type class
// THIS DEFINITELY WORKS
public function getTaxonomies() {
  return array(
    'news-type' => array(
      'rewrite' => array(
        'slug' => 'news'
      )
    )
  );
}

// Or possibly this in the taxonomy class
public function getRewrite() {
  return array('slug' => 'programs');
}
