/**
 * Get random post IDs from a subset of most recent posts
 * @param string $post_type
 * @param int $recent_limit
 * @param int $random_limit
 * @return array
 */
public static function getRandomFromRecent($post_type, $recent_limit=10, $random_limit=3) {
  global $wpdb;
  $sql_get_random_from_recent = sprintf(
    "SELECT ID
    FROM (
      SELECT ID
      FROM %s
      WHERE post_type = '%s'
      AND post_status = 'publish'
      ORDER BY post_date DESC
      LIMIT %d
    ) AS recent
    ORDER BY RAND()
    LIMIT %d",
    $wpdb->posts,
    esc_sql($post_type),
    $recent_limit,
    $random_limit
  );
  $random_ids = $wpdb->get_results($sql_get_random_from_recent, ARRAY_A);
  return (Arr::iterable($random_ids))
    ? Collection::pluck($random_ids, 'ID')
    : null;
}