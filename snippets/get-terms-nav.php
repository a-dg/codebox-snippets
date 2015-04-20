/**
 * Get links for available terms within one taxonomy (not hierarchical)
 * @param string $taxonomy
 * @param string $current_class
 * @param string $link_prefix
 * @param obj $current_term
 * @param obj $current_post
 * @return string HTML
 */
public static function getTermsNav($taxonomy, $current_class='current-term', $link_prefix=null, $current_term=null, $current_post=null) {
  $terms = \Taco\Term\Factory::createMultiple(get_terms($taxonomy));
  if(!Arr::iterable($terms)) return null;
  
  if(!Obj::iterable($current_term)) {
    $current_term = \Taco\Term\Factory::create(get_queried_object());
  }
  
  $term_links = array();
  $current_class = ' class="'.$current_class.'"';
  if(is_null($link_prefix)) $link_prefix = '/'.$taxonomy.'/';
  
  $is_taxonomy_template = false;
  $current_post_term = null;
  if(Obj::iterable($current_term)) {
    // We are on a taxonomy/category template
    $is_taxonomy_template = true;
  } else {
    // We are on a single page/post
    if(!Obj::iterable($current_post)) {
      global $post;
      $current_post = \Taco\Post\Factory::create($post);
    }
    $current_post_term = reset($current_post->getTerms($taxonomy));
  }
  
  foreach($terms as $term) {
    $term_class = null;
    if(
      (
        $is_taxonomy_template
        && (int) $current_term->term_id === (int) $term->term_id
      ) || (
        Obj::iterable($current_post_term)
        && (int) $current_post_term->term_id === (int) $term->term_id
      )
    ) {
      $term_class = $current_class;
    }
    $term_links[] = sprintf(
      '<li%s><a href="%s%s/">%s</a></li>',
      $term_class,
      $link_prefix,
      $term->slug,
      $term->name
    );
  }
  
  return sprintf(
    '<ul>
      %s
    </ul>',
    join('', $term_links)
  );
}