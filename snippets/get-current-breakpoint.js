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
  
  // TODO: use index in breakpoints array to determine if the one breakpoint is narrower or wider than another, instead of doing something like if(breakpoint == 'medium' || breakpoint == 'average' || breakpoint == 'large')
  // return [breakpoint, breakpoints.indexOf(breakpoint)];
}