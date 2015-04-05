/**
 * Get events sorted by event date, optionally isolated to one page of results
 * @param int $page_number
 * @param int $per_page
 * @param bool $return_count
 * @return array
 */
public static function getSorted($page_number=null, $per_page=null, $return_count=false) {
  $limit = null;
  if(!is_null($page_number) && !is_null($per_page)) {
    // Get one page of results
    $limit = sprintf(
      "LIMIT %d OFFSET %d",
      $per_page,
      ($page_number - 1) * $per_page
    );
  } elseif(is_null($page_number) && !is_null($per_page)) {
    // Get the first n results
    $limit = sprintf(
      "LIMIT %d",
      $per_page
    );
  }
  
  $select = ($return_count)
    ? "COUNT(DISTINCT p.ID) AS total"
    : "p.ID, pm.meta_value AS event_date";
  $order = (!$return_count)
    ? "ORDER BY event_date DESC"
    : null;
  
  global $wpdb;
  $sql_events_sorted = sprintf(
    "SELECT %s
    FROM %s AS p
    INNER JOIN %s AS pm ON (p.ID = pm.post_id)
    WHERE p.post_type = 'event'
    AND pm.meta_key = 'event_date'
    %s
    %s",
    $select,
    $wpdb->posts,
    $wpdb->postmeta,
    $order,
    $limit
  );
  $results = $wpdb->get_results($sql_events_sorted, ARRAY_A);
  
  if($return_count) {
    return (Arr::iterable($results))
      ? reset(reset($results))
      : 0;
  }
  return (Arr::iterable($results))
    ? \Taco\Post\Factory::createMultiple(Collection::pluck($results, 'ID'))
    : array();
}