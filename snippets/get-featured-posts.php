$featured_posts = PostType::getBy('is_featured', 1);
if(Arr::iterable($featured_posts)) {
  foreach($featured_posts as $featured_post) {
    echo $featured_post->getTheTitle();
  }
}