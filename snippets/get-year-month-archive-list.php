/**
 * Get hierarchical list of years and months, with post counts
 * @return string HTML
 */
public static function getArchiveList() {
  global $wpdb;
  $sql_get_archives = sprintf(
    "SELECT
      SUBSTRING(post_date, 1, 4) AS unique_year,
      SUBSTRING(post_date, 6, 2) AS unique_month,
      COUNT(1) AS count_each
    FROM %s
    WHERE post_type = '%s'
    AND post_status = 'publish'
    GROUP BY unique_year, unique_month
    ORDER BY unique_year DESC, unique_month DESC",
    $wpdb->posts,
    'article' // static::getPostType()
  );
  $results = $wpdb->get_results($sql_get_archives, ARRAY_A);
  if(!Arr::iterable($results)) return null;
  
  $years = array();
  $results = Collection::groupBy($results, 'unique_year');
  foreach($results as $year => $months) {
    $year_group = array();
    foreach($months as $month) {
      $year_group[] = sprintf(
        '<li><a href="/%s/%s/">%s (%s post%s)</a></li>',
        $month['unique_year'],
        $month['unique_month'],
        date('F', mktime(null, null, null, $month['unique_month'])),
        $month['count_each'],
        ($month['count_each'] > 1) ? 's' : null
      );
    }
    $years[] = sprintf(
      '<li>%s
        <ul>
          %s
        </ul>
      </li>',
      $year,
      join('', $year_group)
    );
  }
  
  return sprintf(
    '<ul>
      %s
    </ul>',
    join('', $years)
  );
}