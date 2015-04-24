;(function($){
  var request = null;
  var current_criteria = null;
  
  function update_results() {
    var criteria = {
      'subject': 'some value',
      'course': 'another value'
    };
    current_criteria = $.param(criteria);
    
    // Cancel any outstanding request that has not finished
    if(request && request.readyState !== 4) {
      request.abort();
    }
    
    // Perform the search via AJAX
    request = $.ajax({
      type: 'GET',
      url: '/path/to/get-results.php',
      data: criteria
    }).done(function(result){
      // Check if request has outdated criteria
      if($.param(criteria) !== current_criteria) {
        return false;
      }
      
      // Display result
      $search_results.html(result);
    });
  }
})(jQuery);
