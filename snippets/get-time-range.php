/**
 * Get human-readable time range from two times
 * Expects 24-hour input time without seconds
 * @param string $time_start
 * @param string $time_end
 * @param bool $return_short
 * @return string
 */
public static function getTimeRange($time_start, $time_end=null, $return_short=false) {
  
  // Clean up
  if($time_start == $time_end) $time_end = null;
  $times = array(
    'start' => array('time' => $time_start),
    'end' => array('time' => $time_end),
  );
  foreach($times as &$time) {
    $time['time'] = trim($time['time']);
    $time = array_filter($time);
    unset($time);
  }
  $times = array_filter($times);
  if(!Arr::iterable($times)) return null;
  
  // Enforce 24-hour time format
  $time_pattern = '/^(0?[0-9]|1[0-9]|2[0-3])\:([0-5][0-9])$/';
  foreach($times as $time) {
    if(!preg_match($time_pattern, $time['time'])) return null;
  }
  
  // Determine period and adjust hour accordingly
  foreach($times as &$time) {
    $the_time =& $time['time'];
    $hour = (int) substr($the_time, 0, strpos($the_time, ':'));
    $time['period'] = ($hour < 12) ? 'am' : 'pm';
    if($hour > 12) {
      $hour -= 12;
      $the_time = $hour.substr($the_time, strpos($the_time, ':'));
    }
    $search_zero = array('/^0{2}/', '/^0/');
    $replace_zero = array('12', '');
    $the_time = preg_replace($search_zero, $replace_zero, $the_time);
    unset($time);
  }
  
  // Shorten format to something like 6:30-10p
  if($return_short) {
    foreach($times as &$time) {
      $the_time =& $time['time'];
      if(strpos($the_time, ':00') !== false) {
        $hour = (int) substr($the_time, 0, strpos($the_time, ':'));
        $the_time = $hour;
      }
      $time['period'] = substr($time['period'], 0, 1);
      unset($time);
    }
  }
  
  $thin_space = '&#8201;';
  $six_per_em_space = '&#8198;';
  $range_separator = $six_per_em_space.'&#8211;'.$six_per_em_space;
  
  // Consolidate times and periods
  if($times['start']['period'] == $times['end']['period']) {
    $times['start']['period'] = null;
  }
  foreach($times as &$time) {
    if(!is_null($time['period'])) {
      $time = $time['time'].$thin_space.$time['period'];
    } else {
      $time = $time['time'];
    }
    unset($time);
  }
  
  return join($range_separator, $times);
}