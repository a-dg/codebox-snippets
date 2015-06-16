;(function($){
  var anim_dur = 300;
  var lazy_class = 'lazy';
  var lazy_bg_class = 'lazy-bg';
  var eager_class = 'eager';
  var working_class = 'working';
  var done_class = 'done';
  var image_attr = 'data-image';
  var non_empty_image_attr = '[' + image_attr + '!=""]';
  var is_webkit = /webkit/.test(navigator.userAgent.toLowerCase());
  var $body = null;
  
  var throttle_check_images = $.throttle(function(){
    check_images();
  }, 200);
  
  
  $(function(){
    $body = $(is_webkit ? 'body' : 'html');
    $(window)
      .on('load', window_load)
      .on('scroll.' + lazy_class, throttle_check_images)
      .on('resize.' + lazy_class, throttle_check_images);
    
    // Check slide images immediately
    check_images('ul.slides');
  });
  
  
  function window_load() {
    setTimeout(function(){
      check_images();
    }, anim_dur);
  }
  function check_images(container_selector) {
    if(container_selector === undefined || container_selector === null) {
      container_selector = '';
    } else {
      container_selector += ' ';
      if(!$($.trim(container_selector)).length) return false;
    }
    var unloaded_image_selector = container_selector
      + 'img.' + lazy_class
      + ':not(.' + working_class + ')'
      + ':not(.' + done_class + ')'
      + non_empty_image_attr;
    var unloaded_bg_selector = container_selector
      + '.' + lazy_bg_class
      + ':not(.' + working_class + ')'
      + ':not(.' + done_class + ')'
      + non_empty_image_attr;
    var ignore_range = !!container_selector.length;
    
    var $eager = $('.' + eager_class + non_empty_image_attr);
    if($eager.length) {
      $eager.filter(unloaded_image_selector).lazyLoad(ignore_range);
      $eager.filter(unloaded_bg_selector).lazyLoadBg(ignore_range);
      return false;
    }
    var $lazy_imgs = $(unloaded_image_selector);
    var $lazy_bgs = $(unloaded_bg_selector);
    if(!$lazy_imgs.length && !$lazy_bgs.length) {
      $(window)
        .off('scroll.' + lazy_class)
        .off('resize.' + lazy_class);
    }
    $lazy_imgs.each(function(){
      $(this).lazyLoad(ignore_range);
    });
    $lazy_bgs.each(function(){
      $(this).lazyLoadBg(ignore_range);
    });
  }
  function is_in_range($obj, lookaround) {
    if(!$obj.is(':visible')) return false;
    
    // Lookaround scales the region to be scanned for unloaded images
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
  
  
  $.fn.lazyLoad = function(ignore_range){
    var $img = this;
    if($img.hasClass(done_class)) return false;
    if(!ignore_range && !is_in_range($img, 0.25)) return false;
    
    var image_url = $img.attr(image_attr);
    var new_image = new Image();
    $(new_image).load(function(){
      $img
        .attr('src', image_url)
        .removeAttr('style ' + image_attr)
        .removeClass(working_class)
        .addClass(done_class);
    }).attr('src', image_url);
    $img.addClass(working_class).removeClass(lazy_class);
  };
  $.fn.lazyLoadBg = function(ignore_range, remove_when_loaded){
    var $bg = this;
    if($bg.hasClass(done_class)) return false;
    if(!ignore_range && !is_in_range($bg, 0.25)) return false;
    
    $bg.addClass(working_class);
    var image_url = $bg.attr(image_attr);
    
    var new_image = new Image();
    $(new_image).on('load', function(){
      $bg
        .css('background-image', 'url(\'' + image_url + '\')')
        .removeAttr(image_attr)
        .removeClass(working_class)
        .addClass(done_class);
      if($bg.hasClass(eager_class)) {
        $bg.removeClass(eager_class);
        check_images();
      }
      
      // Optionally remove .lazy-bg elements if .loaded container has
      // a background image that should be displayed once all other
      // backgrounds have loaded
      if(remove_when_loaded) {
        setTimeout(function(){
          var $container = $bg.parent();
          if(!$container.children(
            '.' + lazy_bg_class
            + ':not(' + working_class + ')'
            + ':not(' + done_class + ')'
          ).length) {
            $container.addClass('loaded').children('.' + lazy_bg_class).remove();
          }
        }, anim_dur);
      }
    }).attr('src', image_url);
  };
})(jQuery);
