/**
 * Get post count by term
 * @param string $taxonomy
 * @param int/array $terms
 * @param bool $include_children
 */
public static function getCountByTerm($taxonomy, $terms, $include_children=false) {
  $tax_query = array(
    array(
      'taxonomy' => $taxonomy,
      'terms' => $terms,
      'include_children' => $include_children
    )
  );
  return self::getCount(array(
    'numberposts' => -1,
    'tax_query' => $tax_query
  ));
}
