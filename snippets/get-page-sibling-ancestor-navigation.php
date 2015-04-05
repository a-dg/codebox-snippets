/**
 * Get page sibling/ancestor navigation links
 * Pass 0 to $page_id for top-level nav only
 * @param int $page_id
 * @param array $args WP_Query args to be merged with defaults
 * @return string HTML
 */
public static function getPageNav($page_id=null, $args=array()) {
  if(is_null($page_id)) {
    global $post;
    $page_id = $post->ID;
  }
  $top_level_page_id = null;
  if($page_id === 0) {
    $top_level_page_id = 0;
    $args['depth'] = 1;
  } else {
    $ancestors = get_post_ancestors($page_id);
    if(Arr::iterable($ancestors)) {
      $top_level_page_id = reset($ancestors);
    } else {
      $top_level_page_id = $page_id;
    }
  }
  
  return wp_list_pages(array_merge(array(
    'child_of' => $top_level_page_id,
    'depth' => 2,
    'title_li' => '',
    'echo' => 0
  ), $args));
}