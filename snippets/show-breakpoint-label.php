if(ENVIRONMENT !== ENVIRONMENT_PROD) {
  if(!defined('SHOW_BREAKPOINT_LABEL') || SHOW_BREAKPOINT_LABEL) {
    $breakpoints = array(
      'tiny',
      'small',
      'medium',
      'average',
      'large',
      'xlarge',
    );
    $breakpoint_labels = array();
    foreach($breakpoints as $breakpoint) {
      $breakpoint_labels[] = '<div class="show-for-'.$breakpoint.'-only">'.$breakpoint.'</div>';
    }
    echo sprintf(
      '<div id="breakpoint-label">
        %s
      </div>',
      join('', $breakpoint_labels)
    );
  }
}