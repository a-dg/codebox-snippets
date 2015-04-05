public function save($exclude_post=false) {
  // Allow the user to enter human readable datetimes
  $datetime_field_keys = array(
    'start_date',
    'end_date',
    'registration_start_date',
    'registration_end_date',
  );
  foreach($datetime_field_keys as $k) {
    $stamp = strtotime($this->$k);
    if(!$stamp) continue;

    $this->$k = date('Y-m-d H:i:s', $stamp);
  }

  return parent::save($exclude_post);
}