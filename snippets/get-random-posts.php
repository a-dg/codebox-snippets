$random_posts = PostType::getWhere(array(
  'numberposts' => 4,
  'orderby' => 'rand'
));
if(Arr::iterable($random_posts)) {
  foreach($random_posts as $random_post) {
    echo $random_post->getTheTitle();
  }
}