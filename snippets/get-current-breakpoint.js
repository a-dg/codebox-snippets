function get_breakpoints() {
  var breakpoints = [
    'tiny',
    'small',
    'medium',
    'average',
    'large',
    'xlarge'
  ];
  return breakpoints;
}
function get_current_breakpoint() {
  var breakpoint = null;
  var breakpoints = get_breakpoints();
  $.each(breakpoints, function(key, val){
    var $detector = $('<div class="show-for-' + val + '-only" data-breakpoint="' + val + '"></div>');
    $('body').append($detector);
    if($detector.is(':visible')) {
      breakpoint = val;
      $detector.remove();
      return false;
    } else {
      $detector.remove();
    }
  });
  return breakpoint;
  // return [breakpoint, breakpoints.indexOf(breakpoint)];
}