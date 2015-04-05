var init_pos = null;
$(window).on('load', function(){
  init_pos = $('#sidebar').offset().top;
}).on('scroll', function(){
  if($(window).scrollTop() > init_pos) {
    $('#sidebar').css({
      position: 'fixed',
      top: '0'
    });
  } else {
    $('#sidebar').css({
      position: 'absolute',
      top: 'auto'
    });
  }
});