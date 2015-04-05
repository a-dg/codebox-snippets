// <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

if(navigator.userAgent.match(/iPad/i)) {
  var device_width = (Math.abs(window.orientation) === 90)
    ? 1024
    : 768;
  var $viewport = $('meta[name="viewport"]');
  var content_attr = 'content';
  var width_prop = 'width=';
  var viewport_content = $viewport.attr(content_attr).split(',');
  viewport_content = $.map(viewport_content, function(el){
    if($.trim(el).substr(0, width_prop.length) === width_prop) {
      return width_prop + device_width;
    }
    return $.trim(el);
  });
  $viewport.attr(content_attr, viewport_content.join(', '));
}