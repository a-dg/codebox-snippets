var throttle_check_fixed_nav = $.throttle(function(){
  check_fixed_nav();
}, 120);
var throttle_adjust_notches = $.throttle(function(){
  adjust_notches();
}, 200);
var throttle_layout = $.throttle(function(){
  $('.fill-space').each(function(){
    $(this).fillSpace();
  });
  $('.apportion').each(function(){
    $(this).apportion();
  });
  set_footer_height();
}, 200);

$(function(){
  // ready
  $(window)
    .on('load', window_load_main)
    .on('resize', throttle_layout)
  ;
});