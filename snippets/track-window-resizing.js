;(function($){
  $(function(){
    var init_window_width,
      prev_window_width,
      total_resize_distance,
      final_resize_delta = 0;
    var threshold = 100;
    var observe_time = 10000;
    var currently_being_observed = false;
    
    $(window).resize(function(){
      if(currently_being_observed) {
        var current_window_width = $(window).width();
        total_resize_distance += Math.abs(prev_window_width - current_window_width);
        prev_window_width = current_window_width;
      } else {
        prev_window_width = $(window).width();
        if(Math.abs(init_window_width - prev_window_width) > threshold) {
          // window is now significantly different width
          currently_being_observed = true;
          total_resize_distance += Math.abs(init_window_width - prev_window_width);
          setTimeout(function(){
            // stop and evaluate total distance
            currently_being_observed = false;
            final_resize_delta = prev_window_width - init_window_width;
            console.log('total_resize_distance: ' + total_resize_distance);
            console.log('final_resize_delta: ' + final_resize_delta);
            if(Math.abs(total_resize_distance) > 500) {
              // google analytics
            }
            reset_values();
          }, observe_time);
        }
      }
    });
    
    function reset_values() {
      init_window_width = $(window).width();
      prev_window_width = 0;
      total_resize_distance = 0;
      final_resize_delta = 0;
      console.log('======== init_window_width: ' + init_window_width);
    }
    reset_values();
  });
})(jQuery);
