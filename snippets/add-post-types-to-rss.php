function myfeed_request($qv) {
  if(isset($qv['feed']) && !isset($qv['post_type'])) {
    $qv['post_type'] = array('post', 'report', 'event');
    return $qv;
  }
}
add_filter('request', 'myfeed_request');
