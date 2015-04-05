function resize_video() {
  var $iframe = $('iframe.wistia_embed');
  if(!$iframe.length) return false;
  
  $iframe.each(function(){
    var aspect_ratio_x = 16;
    var aspect_ratio_y = 9;
    var height = Math.round((($(this).width() * aspect_ratio_y) / aspect_ratio_x) / 2) * 2;
    $(this).height(height);
  });
}