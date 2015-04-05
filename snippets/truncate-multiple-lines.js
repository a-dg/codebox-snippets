$.fn.trunc = function(){
  var $t = this;
  
  // Return entire element if it contains any extra HTML
  if($t.html().indexOf('<') !== -1) return false;
  
  // Copy original text to data attribute
  var original_text = null;
  var original_text_attr = 'data-original';
  if(!$t.filter('[' + original_text_attr + ']').length) {
    original_text = $t.html().replace(/"/g, '&quot;');
    $t.attr(original_text_attr, original_text);
  } else {
    original_text = $t.attr(original_text_attr);
  }
  
  // Get height of ellipses_text to determine line height
  var ellipses_text = '\u00a0\u2026'; // &nbsp;&hellip;
  var $ellipses = $t.clone();
  $ellipses
    .removeClass(truncate_class)
    .addClass(truncate_clone_class)
    .appendTo($t.parent())
    .text(ellipses_text);
  var line_height = $ellipses.height();
  $ellipses.remove();
  
  // Set maximum number of lines of text
  var max_lines_attr = 'data-trunc';
  var max_lines_default = 3;
  var max_number_of_lines = ($t.filter('[' + max_lines_attr + ']').length)
    ? Math.max(parseInt($t.attr(max_lines_attr)), 1)
    : max_lines_default;
  var max_height = line_height * max_number_of_lines;
  
  var original_words = original_text.split(' ');
  original_words = original_words.filter(function(val){
    return !!val.length;
  });
  var halved_words = original_words;
  var stopped_at_index = 0;
  
  // Cut original text in half until it's short enough
  while($t.height() > max_height) {
    stopped_at_index = Math.ceil(halved_words.length / 2);
    halved_words = halved_words.slice(0, stopped_at_index);
    $t.html(halved_words.join(' '));
    
    // If it's really short, just stop
    if(halved_words.length < 2) {
      $t.html($t.html() + ellipses_text);
      return false;
    }
  }
  
  if($t.html() !== original_text) {
    // Add back one word at a time, plus ellipses_text
    while($t.height() <= max_height) {
      if(stopped_at_index - 1 > original_words.length) {
        break;
      }
      $t.html(original_words.slice(0, stopped_at_index).join(' ') + ellipses_text);
      stopped_at_index++;
    }
    
    // If added all words back, just use original_text
    if(stopped_at_index - 1 > original_words.length) {
      $t.html(original_text);
      return false;
    }
    
    // The last word added caused the element to exceed max_height,
    // and we've already incremented stopped_at_index, so reduce
    // stopped_at_index by 2 and use that slice as the text
    $t.html(original_words.slice(0, (stopped_at_index - 2)).join(' ') + ellipses_text);
  }
};