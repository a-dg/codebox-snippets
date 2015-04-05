$.extend({
  debounce: function(fn, timeout, invoke_asap, ctx){
    if(arguments.length === 3 && typeof invoke_asap !== 'boolean') {
      ctx = invoke_asap;
      invoke_asap = false;
    }
    var timer;
    return function(){
      var args = arguments;
      ctx = ctx || this;
      if(invoke_asap && !timer) {
        fn.apply(ctx, args);
      }
      clearTimeout(timer);
      timer = setTimeout(function(){
        if(!invoke_asap) {
          fn.apply(ctx, args);
        }
        timer = null;
      }, timeout);
    };
  },
  throttle: function(fn, timeout, ctx){
    var timer, args, need_invoke;
    return function(){
      args = arguments;
      need_invoke = true;
      ctx = ctx || this;
      if(!timer) {
        (function(){
          if(need_invoke) {
            fn.apply(ctx, args);
            need_invoke = false;
            timer = setTimeout(arguments.callee, timeout);
          } else {
            timer = null;
          }
        })();
      }
    };
  }
});