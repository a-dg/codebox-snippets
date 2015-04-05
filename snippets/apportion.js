$.fn.apportion = function(){
  var $t = this;
  var total_columns = 12;
  var classes = $t.attr('class');
  var all_classes = classes.split(' ');
  var number_of_groups = 1;
  $.each(all_classes, function(key, val){
    if(val.indexOf(breakpoint) !== -1) {
      number_of_groups = parseInt(val.substring(val.lastIndexOf('-') + 1));
      return false;
    }
  });
  
  var li_selector = $t.attr('data-ap-selector');
  var li_class = $t.attr('data-ap-class');
  var li_backload = $t.attr('data-ap-backload');
  li_backload = (li_backload.toLowerCase() === 'true')
    ? true
    : false;
  if(!li_selector)  li_selector = 'ap-li';
  if(!li_class)     li_class = 'ap-li';
  if(!li_backload)  li_backload = false;
  
  if(number_of_groups > 0 && number_of_groups <= total_columns) {
    // We use the smallest breakpoint for the class name
    // to prevent fast window resizing from breaking the grid
    var breakpoints = get_breakpoints();
    var group_class_name = breakpoints[0] + '-block-grid-' + number_of_groups;
    var $list_items = $t.find(li_selector);
    if($list_items.length === 0) return false;
    
    var list_items_html = [];
    $list_items.each(function(){
      var original_classes = $(this).attr('class');
      original_classes = original_classes.replace(/ap-li\s+/g, '');
      list_items_html.push('<li class="' + li_class + ' ' + original_classes + '">' + $(this).html() + '</li>');
    });
    var groups = split_array(list_items_html, number_of_groups, li_backload);
    
    var new_html = '<div class="columns"><ul class="' + group_class_name + '">';
    $.each(groups, function(key, val){
      new_html += '<li><ul class="ap-group">' + val.join('') + '</ul></li>';
    });
    new_html += '</ul></div>';
    $t.html(new_html);
  }
};