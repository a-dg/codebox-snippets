/**
 * Get comma-separated list of terms
 * @param string $taxonomy
 * @return string HTML
 */
public function getTermList($taxonomy) {
  if(is_null($taxonomy)) return null;
  $terms = $this->getTerms($taxonomy);
  if(!\Arr::iterable($terms)) return null;
  
  $term_list = array();
  foreach($terms as $term) {
    $term_list[] = sprintf(
      '<span data-term-id="%d">%s</span>',
      $term->term_id,
      $term->name
    );
  }
  return sprintf(
    '<p class="meta terms %s"><strong>%s%s:</strong> %s</p>',
    $taxonomy,
    \Str::human($taxonomy),
    (count($term_list) > 1) ? 's' : null,
    join(', ', $term_list)
  );
}