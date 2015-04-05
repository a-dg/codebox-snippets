$('li').filter(function(){
  $this = $(this);
  return !(
    $.trim($this.text()).length
    || $this.has('img').length
  );
}).remove();
