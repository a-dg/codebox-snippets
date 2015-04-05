/**
 * Get human-readable date range from two dates
 * @param string $date_start
 * @param string $date_end
 * @param array $args
 * - string $incoming_format
 * - bool $return_short
 * - bool $return_dates_only
 * @return string/array
 */
public static function getDateRange($date_start, $date_end=null, $args=array()) {
  if(empty($date_start)) return null;
  
  $default_args = array(
    'incoming_format' => 'Y-m-d',
    'return_short' => false,
    'return_dates_only' => true,
  );
  $args = (Arr::iterable($args))
    ? array_merge($default_args, $args)
    : $default_args;
  extract($args);
  
  $date_start = date_format(date_create_from_format($incoming_format, $date_start), 'U');
  if(strlen($date_end)) {
    $date_end = date_format(date_create_from_format($incoming_format, $date_end), 'U');
  }
  
  $date_range = null;
  $is_single_day = false;
  $year = ($return_short) ? '' : ', Y';
  $month = ($return_short) ? 'M ' : 'F ';
  $day = 'j';
  if(
    date('Y-m-d', $date_start) == date('Y-m-d', $date_end)
    || empty($date_end)
  ) {
    $date_range = date($month.$day.$year, $date_start);
    $is_single_day = true;
  } elseif(date('Y-m', $date_start) == date('Y-m', $date_end)) {
    $date_range = date($month.$day, $date_start).'&#8211;'.date($day.$year, $date_end);
  } elseif(date('Y', $date_start) == date('Y', $date_end)) {
    $date_range = date($month.$day, $date_start).' &#8211; '.date($month.$day.$year, $date_end);
  } else {
    $date_range = date($month.$day.$year, $date_start).' &#8211; '.date($month.$day.$year, $date_end);
  }
  
  return ($return_dates_only)
    ? $date_range
    : array(
        'dates' => $date_range,
        'is_single_day' => $is_single_day,
      );
}