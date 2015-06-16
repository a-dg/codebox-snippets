var words = [];
$.getJSON('/js/topics.json', function(data){
  words = data.topics;
});
