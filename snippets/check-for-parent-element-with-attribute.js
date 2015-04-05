$.extend($.fn, {
  hasParent: function(p){
    return this.filter(function(){
      return $(p).find(this).length;
    });
  }
});

$('li').hasParent('#lightbox').each(function(){
  $(this).addClass('on');
});
