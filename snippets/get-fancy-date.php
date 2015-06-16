/**
 * Get the fancy date
 * @param string $post_date
 * @return string
 */
function app_get_fancy_date($post_date) {
  $post_timestamp = strtotime($post_date);
  if(!$post_timestamp) return $post_date;
  
  $age_seconds = microtime(true) - $post_timestamp;
  $age_days = floor($age_seconds / (24 * 60 * 60));
  if($age_days == 0) return 'Today';
  if($age_days == 1) return 'Yesterday';
  
  return ($age_seconds < (5*24*60*60))
    ? sprintf('%d days ago', $age_days)
    : date('F j, Y', $post_timestamp);
}
