/**
 * Get list of terms hierarchically, as select form element or list
 * @param string $taxonomy
 * @param obj $current_term
 * @param bool $as_form
 * @return string
 */
public static function getHierarchicalTermList($taxonomy, $current_term=null, $as_form=false) {
  $terms = \Taco\Term\Factory::createMultiple(get_terms($taxonomy));
  if(!Arr::iterable($terms)) return null;
  
  
  
  $current_class = ' class="current_page_item"';
  $ancestor_class = ' class="current_page_ancestor"';
  
  
  $html = '';
  
  $by_parent = Collection::groupBy($terms, 'parent');
  foreach($by_parent[0] as $term) {
    $this_class = null;
    if(Obj::iterable($current_term)) {
      if($term->term_id === $current_term->term_id) {
        $this_class = $current_class;
      } elseif($term->term_id === $current_term->parent) {
        $this_class = $ancestor_class;
      }
    }
    $html .= sprintf(
      '<li%s><a href="/%s/%s/">%s</a>',
      $this_class,
      $term->taxonomy,
      $term->slug,
      $term->name
    );
    if(array_key_exists($term->term_id, $by_parent)) {
      $html .= '<ul>';
      foreach($by_parent[$term->term_id] as $child_term) {
        $this_class = null;
        if(Obj::iterable($current_term)) {
          if($child_term->term_id === $current_term->term_id) {
            $this_class = $current_class;
          } elseif($child_term->term_id === $current_term->parent) {
            $this_class = $ancestor_class;
          }
        }
        $html .= sprintf(
          '<li%s><a href="/%s/%s/">%s</a></li>',
          $this_class,
          $child_term->taxonomy,
          $child_term->slug,
          $child_term->name
        );
      }
      $html .= '</ul>';
    }
    $html .= '</li>';
  }
  
  return $html;
}