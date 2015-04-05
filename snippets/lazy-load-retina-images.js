;(function($){
  var anim_dur = 300;
  var retina_class = 'retinafy';
  var retina_suffix = '@2x';
  var is_webkit = /webkit/.test(navigator.userAgent.toLowerCase());
  var $body = null;
  
  $(function(){
    $body = $(is_webkit ? 'body' : 'html');
    // if(window.devicePixelRatio > 1.5) {
      $(window).scroll(function(){
        check_images();
      });
    // }
  });
  $(window).on('load', function(){
    // if(window.devicePixelRatio > 1.5) {
    check_images();
    // }
  });
  function check_images() {
    $('img.' + retina_class).each(function(){
      if(is_in_viewport($(this), 0.25)) {
        load_image($(this));
        $(this).removeClass(retina_class);
      }
    });
  }
  function url_exists(url) {
    var req = new XMLHttpRequest();
    req.open('HEAD', url, false);
    req.send();
    return (req.status != 404);
  }
  function is_in_viewport($obj, lookahead) {
    if(!$obj.is(':visible')) return false;
    
    // Lookahead scales region to be scanned for unloaded images
    // 0 = Only load images that are visible in the viewport (even a single pixel row)
    // 0.5 = Look outside of viewport by an additional 50% of its height
    var obj_top = $obj.offset().top;
    var obj_height = $obj.height();
    var window_top = $body.scrollTop();
    var window_height = $(window).height();
    
    var top_in_range = (obj_top < window_top + (window_height * (1 + lookahead)));
    var bottom_in_range = (obj_top + obj_height > window_top - (window_height * lookahead));
    return (top_in_range && bottom_in_range);
  }
  function load_image($img) {
    var source = $img.attr('src');
    var img_name = source.substring(0, source.lastIndexOf('.'));
    var img_suffix = source.substring(source.lastIndexOf('.'));
    var retina_source = img_name + retina_suffix + img_suffix;
    
    if(url_exists(retina_source)) {
      var retina_image = new Image();
      $(retina_image).animate({
        opacity: 0
      }, 0, function(){
        $(this).load(function(){
          // TODO: why add .retina? is it like .working?
          $(this).addClass('retina').delay(2000).animate({
            opacity: 1
          }, 1000, function(){
            // TODO: why remove style instead of specific css property?
            $(this).removeClass('retina').removeAttr('style');
            $img.remove();
          });
          $img.parent().append(this);
        }).attr('src', retina_source);
      });
    }
  }
})(jQuery);
