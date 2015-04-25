;(function($){
  var update_timer = null;
  var current_query = '';
  var $suggestions = null;
  
  $(document).on('click', '.autocomplete-suggestion', function(e){
    select_suggestion(e);
  }).on('hover', '.autocomplete-suggestion', function(e){
    hover_suggestion(e);
  }).on('focus', '.autocomplete-input', function(e){
    focus_field(e);
  }).on('blur', '.autocomplete-input', function(e){
    blur_field(e);
  }).on('keyup', '.autocomplete-input', function(e){
    keyup_field(e);
  }).on('keydown', function(e){
    keydown_field(e);
  });
  
  
  function select_suggestion(e) {
    var $suggestion = $(e.target);
    $suggestion
      .closest('.autocomplete-container')
      .find('.autocomplete-input')
      .val($suggestion.text()).blur();
    assign_hidden_value($suggestion, $suggestion.attr('data-post-id'));
    /*
    if($suggestion.closest('.autocomplete-suggestions').attr('data-post-type') == 'course') {
      $suggestion
        .closest('tr')
        .siblings('tr.hidden')
        .find('input#catalog_id')
        .val($suggestion.attr('data-catalog-id'));
    }
    */
  }
  function hover_suggestion(e) {
    var $suggestion = $(e.target);
    $suggestion.addClass('hovered').siblings().removeClass('hovered');
  }
  function focus_field(e) {
    var $input = $(e.target);
    $suggestions = $input.next('.autocomplete-suggestions');
    current_query = '';
    if(!$suggestions.is(':empty')) {
      $suggestions.show();
    }
    // if($input.val().length > 10) {
    //   $input.select();
    // }
  }
  function blur_field(e) {
    var $input = $(e.target);
    $suggestions = $input.next('.autocomplete-suggestions');
    setTimeout(function(){
      $suggestions.hide();
    }, 100);
  }
  function keyup_field(e) {
    var $input = $(e.target);
    if(e.which == 13) return false; // disable enter key
    if(e.which == 27) {
      // escape key
      $input.val('').blur();
      $suggestions = $input.next('.autocomplete-suggestions');
      assign_hidden_value($suggestions, '');
    }
    var new_query = $.trim($input.val());
    if(
      new_query != $.trim(current_query)
      && (new_query.length > 2 || new_query.length === 0)
    ) {
      var post_type = $input.next('.autocomplete-suggestions').attr('data-post-type');
      clearTimeout(update_timer);
      update_timer = setTimeout(function(){
        update_results(new_query, post_type);
      }, 400);
    } else if(new_query === '') {
      $suggestions.hide();
    }
  }
  function keydown_field(e) {
    if(!$suggestions || !$suggestions.is(':visible')) return false;
    
    var $selected = $suggestions.children('.hovered');
    if(e.which == 13) {
      if($selected.length !== 0) {
        $selected.click();
      }
      return false;
    }
    if(e.which == 38 || e.which == 40) {
      var selected_index = $selected.index();
      var new_index = null;
      if($selected.length === 0) {
        selected_index = -1;
      }
      if(e.which == 38) {
        // 38 = up
        new_index = selected_index - 1;
        if(new_index < 0) {
          new_index = $suggestions.children().length - 1;
        }
      } else if(e.which == 40) {
        // 40 = down
        new_index = (selected_index == -1) ? 0 : selected_index + 1;
        if(new_index > $suggestions.children().length - 1) {
          new_index = 0;
        }
      }
      $suggestions.children().eq(new_index).addClass('hovered').siblings().removeClass('hovered');
      e.preventDefault();
    }
  }
  function assign_hidden_value($suggestions, val) {
    $suggestions
      .closest('.autocomplete-suggestions').hide()
      .closest('tr')
      // .next('tr.hidden')
      .next('tr')
      .find('input')
      .val(val);
  }
  function update_results(search_value, post_type_slug) {
    $.ajax({
      type: 'GET',
      url: '/wp-content/plugins/custom/js/autocomplete.php',
      data: {
        search_term: search_value,
        post_type: post_type_slug
      }
    }).done(function(result){
      current_query = search_value;
      if(result) {
        $suggestions.show().html(result).parent().css('position', 'relative');
      } else {
        $suggestions.hide();
      }
    });
  }
})(jQuery);
