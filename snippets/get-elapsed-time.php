function get_elapsed_time($time) {
  if(preg_match('/\D/', $time)) {
    $time = strtotime($time);
  }
  $time = time() - $time;
  $tokens = array (
    31536000 => 'year',
    2592000 => 'month',
    604800 => 'week',
    86400 => 'day',
    3600 => 'hour',
    60 => 'minute',
    1 => 'second'
  );
  foreach($tokens as $unit => $text) {
    if($time < $unit) continue;
    $number_of_units = floor($time / $unit);
    return $number_of_units.' '.$text.(($number_of_units > 1) ? 's' : null);
  }
  return '1 second';
}
