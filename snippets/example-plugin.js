;(function($){
  var post_type;
  var all_post_ids = [];
  var total_number_of_posts;
  var $resave_button;
  var $progress;
  $(document).on('click', 'button.resave-all-posts', function(){
    $resave_button = $(this);
    $resave_button.attr('disabled', 'disabled');
    $progress = $resave_button.next('span.progress-container');
    $progress.show().children().removeClass('done').width(0);
    
    post_type = $resave_button.data('content-type');
    all_post_ids = $resave_button.data('post-ids').split(',');
    total_number_of_posts = all_post_ids.length;
    save_next_post_set();
  });
  function save_next_post_set() {
    var post_set_size = (all_post_ids.length >= 5) ? 5 : all_post_ids.length;
    var post_set_ids = all_post_ids.splice(0, post_set_size);
    $progress.children().width(Math.floor(((total_number_of_posts - all_post_ids.length) / total_number_of_posts) * $progress.width()));
    $.ajax({
      type: 'GET',
      url: '/wp-content/plugins/resave-all-posts/resave-all.php',
      data: {
        content_type: post_type,
        post_ids: post_set_ids.join(',')
      }
    }).done(function(result){
      if(all_post_ids.length) {
        save_next_post_set();
      } else {
        $progress.children().addClass('done').end().delay(1000).fadeOut();
      }
    });
  }
})(jQuery);
