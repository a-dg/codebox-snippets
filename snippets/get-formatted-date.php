/**
 * Get formatted date
 * @return string HTML
 */
public function getDate() {
  if($this->getPostType() !== 'event') {
    return sprintf(
      '<p class="meta date">%s</p>',
      mysql2date('M j, Y', $this->post_date)
    );
  }
  
  $date_start = trim($this->event_date_start);
  $date_end = trim($this->event_date_end);
  return (strlen($date_start.$date_end))
    ? sprintf(
        '<p class="meta date">%s</p>',
        Util::getDateRange($date_start, $date_end)
      )
    : null;
}