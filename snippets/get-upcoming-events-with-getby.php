/**
 * Get events that start in the future
 * @param int $limit
 * @param bool $load_terms
 * @return array
 */
public static function getUpcoming($limit=3, $load_terms=true) {
  return self::getBy('end_date', date('Y-m-d H:i:s'), '>', array('numberposts'=>$limit), $load_terms);
}
