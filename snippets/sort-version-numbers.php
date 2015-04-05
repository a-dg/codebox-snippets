$versions = array(
  '4.1.0',
  '1.5',
  '3.14.4',
  '4.1.10',
  '11.6.1',
  '4.1.3',
  '4.1',
  '4.10',
  '0.1',
  '1.2.0.1',
  '1.0.4.1',
  '1.201',
  '8',
);

usort($versions, function($a, $b){
  $a_parts = array_map('intval', explode('.', $a));
  $b_parts = array_map('intval', explode('.', $b));
  $max = max(count($a_parts), count($b_parts));
  
  for($i = 0; $i < $max; $i++) {
    if(
      array_key_exists($i, $a_parts)
      && array_key_exists($i, $b_parts)
    ) {
      if($a_parts[$i] === $b_parts[$i]) continue;
      return ($a_parts[$i] < $b_parts[$i]) ? -1 : 1;
    } elseif(!array_key_exists($i, $a_parts)) {
      return -1;
    }
    return 1;
  }
  return 1;
});