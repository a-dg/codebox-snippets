var $children = $t.children().filter(function(){
  return $(this).data('element_type') !== undefined;
});
