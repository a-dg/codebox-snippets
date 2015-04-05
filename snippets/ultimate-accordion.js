var acc_anim_dur = 200;
$(document).on('click', '.acc-head', function(e){
  var $c = $(this).parent();
  if(!$c.hasClass('open')) {
    var $o = $('.open');
    var st = $(window).scrollTop();
    var cy = $c.offset().top;
    var wh = $(window).height();

    if($o.length != 0 && $o.index() < $c.index()) {
      // open item is above clicked item
      var oy = $o.offset().top;
      var ch = get_hidden_acc_height($c, $c.closest('.acc'));
      if(cy + ch > st + wh) { // incorporate oh here so we never scroll up if ch > oh
        // height of $c will cause it to go off bottom of window
        // scroll up by difference between open and clicked height
        // clicked height is always bigger than open height in this case
        var oh = $o.find('.acc-body').height();
        var wy = Math.min(((cy + ch) - (oh + wh)), (cy - oh), cy);
        
        $('html, body').animate({
          scrollTop: wy
        }, acc_anim_dur);
      } else {
        // scroll up by open height
        var oh = $o.find('.acc-body').height();
        var wy = st - oh;
        // clicked item is partially off top of window, adjust scrollTop destination
        wy = (cy < st) ? wy - (st - cy) : wy;
        $('html, body').animate({
          scrollTop: wy
        }, acc_anim_dur);
      }
    } else {
      // open item is below clicked item
      var ch = get_hidden_acc_height($c, $c.closest('.acc'));
      if(cy + ch > st + wh) {
        // height of $c will cause it to go off bottom of window
        // scroll down by amount needed
        var wy = Math.min((cy + ch - wh), cy);
        wy = (cy < st) ? wy - (st - cy) : wy;
        $('html, body').animate({
          scrollTop: wy
        }, acc_anim_dur);
      } else if(cy < st) {
        // clicked item is partially off top of window
        $('html, body').animate({
          scrollTop: cy
        }, acc_anim_dur);
      }
    }

    if($o.length != 0) {
      $o.removeClass('open').find('.acc-body').slideUp(acc_anim_dur);
    }
    $c.addClass('open').find('.acc-body').slideDown(acc_anim_dur);
  } else {
    $c.removeClass('open').find('.acc-body').slideUp(acc_anim_dur);
  }
  return false;
});