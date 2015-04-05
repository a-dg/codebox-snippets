$recent_posts = PostType::getWhere(array(
  'numberposts' => 4,
  'orderby' => 'date',
  'order' => 'DESC'
));
if(Arr::iterable($recent_posts)) {
  foreach($recent_posts as $recent_post) {
    echo $recent_post->getTheTitle();
  }
}