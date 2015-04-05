/**
 * Get formatted date
 * @return string HTML
 */
public function getDate() {
  if($this->getPostType() != 'event') {
    return sprintf(
      '<p class="meta date">%s</p>',
      mysql2date('M j, Y', $this->get('post_date'))
    );
  }
  
  $date_start = trim($this->get('event_date_start'));
  $date_end = trim($this->get('event_date_end'));
  return (strlen($date_start.$date_end))
    ? sprintf(
        '<p class="meta date">%s</p>',
        Util::getDateRange($date_start, $date_end)
      )
    : null;
}