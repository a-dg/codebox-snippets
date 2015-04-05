/**
 * Get breadcrumbs HTML
 * @param \Taco\Post $post_obj
 * @return string HTML
 */
public static function getBreadcrumbs(\Taco\Post $post_obj) {
  $separator = ' &raquo; ';
  $post_id = $post_obj->get('ID');
  $post_type = $post_obj->getPostType();
  $ancestor_links = array();
  $post_title = null;
  
  if(is_archive()) {
    // This is the blog archive, what to do for breadcrumbs here?
    return null;
  }
  if($post_type == 'page') {
    $post_title = $post_obj->getTheTitle();
    $ancestors = get_post_ancestors($post_id);
    if(Arr::iterable($ancestors)) {
      $ancestors = array_reverse($ancestors);
      foreach($ancestors as $ancestor_post_id) {
        $ancestor = \Taco\Post\Factory::create($ancestor_post_id, false);
        $single_post = get_post($post_id);
        $ancestor_links[] = sprintf(
          '<li><a href="%s">%s</a></li>',
          $ancestor->getPermalink(),
          $ancestor->getTheTitle()
        );
      }
    }
  } elseif($post_type == 'article') {
    $ancestor_links[] = '<li><a href="'.URL_NEWS.'">News</a></li>';
    $topics = $post_obj->getTerms('topic');
    if(Arr::iterable($topics)) {
      $topic = reset($topics);
      $ancestor_links[] = sprintf(
        '<li><a href="%s">%s</a></li>',
        $topic->getPermalink(),
        $topic->get('name')
      );
    }
  }
  
  // Don't display breadcrumbs unless there's at least one ancestor
  if(!Arr::iterable($ancestor_links)) return null;
  
  return sprintf(
    '<ul class="bread-crumbs">
      %s
      <li>%s</li>
    </ul>',
    join('', $ancestor_links),
    $post_title
  );
}