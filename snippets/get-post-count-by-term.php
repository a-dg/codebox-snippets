/**
 * Get post count for a specific taxonomy and term
 * @param string $taxonomy
 * @param int/string/array $terms
 * @param string $field
 * @param bool $include_child_terms
 * @return int
 */
public static function getCountByTerm($taxonomy, $terms, $field='slug', $include_child_terms=false) {
  $criteria = array(
    'tax_query' => array(
      array(
        'taxonomy' => $taxonomy,
        'terms' => $terms,
        'field' => $field,
        'include_children' => $include_child_terms,
      )
    )
  );
  return self::getCount($criteria);
}