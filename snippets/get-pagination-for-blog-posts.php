$current_page = (get_query_var('paged')) ?: 1;
$per_page = get_option('posts_per_page');
// Or: $per_page = Post::getPostsPerPage();

$all_posts = Post::getWhere(array(
  'orderby' => 'date',
  'order' => 'DESC',
  'posts_per_page' => $per_page,
  'offset' => ($current_page - 1) * $per_page
));

$total_posts = Post::getCount();
echo Util::getPagination($current_page, $total_posts, array(
  'per_page' => $per_page,
  'link_prefix' => '/blog/',
));
