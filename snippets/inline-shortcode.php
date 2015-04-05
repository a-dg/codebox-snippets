function app_num_posts($attribs) {
  $type = (array_key_exists('type', $attribs))
    ? $attribs['post_type']
    : reset($attribs);
  $post_type = \Taco\Post\Factory::create((object) array('post_type'=>$type));
  return $post_type->getCount();
}
add_shortcode('num_posts', 'app_num_posts');


echo trim(apply_filters('the_content', '[num_posts employee]'));
