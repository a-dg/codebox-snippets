;(function($){
  var anim_dur = 300;
  var lazy_class = 'lazy';
  var lazy_bg_class = 'lazy-bg';
  var working_class = 'working';
  var faded_class = 'faded';
  var is_webkit = /webkit/.test(navigator.userAgent.toLowerCase());
  var $body = null;
  var page_loaded = false;
  
  var throttle_check_images = $.throttle(function(){
    check_images();
  }, 200);
  
  
  $(function(){
    // ready
    $body = $(is_webkit ? 'body' : 'html');
    $(window)
      .on('load', window_load)
      .on('scroll.lazy', throttle_check_images)
      .on('resize.lazy', throttle_check_images);
  });
  
  
  function window_load() {
    setTimeout(function(){
      check_images();
    }, anim_dur);
  }
  function check_images() {
    var $lazy_imgs = $('img.' + lazy_class + ':not(.' + working_class + ')');
    var $lazy_bgs = $('.' + lazy_bg_class + '.' + faded_class + ':not(.' + working_class + ')');
    if(!$lazy_imgs.length && !$lazy_bgs.length) {
      $(window)
        .off('scroll.lazy')
        .off('resize.lazy');
    }
    $lazy_imgs.each(function(){
      $(this).lazyLoad();
    });
    $lazy_bgs.each(function(){
      $(this).lazyLoadBg();
    });
  }
  function is_in_range($obj, lookaround) {
    if(!$obj.is(':visible')) return false;
    
    // Lookaround scales the region to be scanned for unloaded images:
    // 0 = Only load images that are visible in the viewport (even a single pixel row)
    // 0.5 = Look outside of the viewport by an additional 50% of its height
    var obj_top = $obj.offset().top;
    var obj_height = $obj.innerHeight();
    var window_top = $body.scrollTop();
    var window_height = $(window).height();
    
    var top_in_range = (obj_top < window_top + (window_height * (1 + lookaround)));
    var bottom_in_range = (obj_top + obj_height > window_top - (window_height * lookaround));
    return (top_in_range && bottom_in_range);
  }
  
  
  $.fn.lazyLoad = function(){
    var $img = this;
    if(!is_in_range($img, 0.25)) return false;
    
    var new_image = new Image();
    var new_source = $img.attr('data-source');
    $(new_image).load(function(){
      $img.attr('src', new_source)
        .removeAttr('style data-source')
        .removeClass(working_class);
    }).attr('src', new_source);
    $img.addClass(working_class).removeClass(lazy_class);
  };
  $.fn.lazyLoadBg = function(){
    var $bg = this;
    if(!is_in_range($bg, 0.25)) return false;
    
    $bg.addClass(working_class);
    var $container = $bg.parent();
    var new_image = new Image();
    $(new_image).on('load', function(){
      $bg.css('background-image', 'url("' + $bg.attr('data-image') + '")');
      $bg.removeClass(faded_class);
      setTimeout(function(){
        $bg.removeClass(working_class);
        if(!$container.children('.' + lazy_bg_class + '.' + faded_class).length) {
          $container.addClass('loaded').find('.' + lazy_bg_class).remove();
        }
      }, anim_dur);
    }).attr('src', $bg.attr('data-image'));
  };
})(jQuery);
