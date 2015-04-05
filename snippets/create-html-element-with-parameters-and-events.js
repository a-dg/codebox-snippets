$('<div/>', {
  'class': 'test',
  'text': 'Click me!',
  click: function(){
    $(this).toggleClass('test');
  }
}).appendTo('body');
