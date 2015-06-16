$category = get_queried_object();
  // ===== OR =====
  $category = reset(get_the_category());
  // ===== OR =====
  $term_id = get_query_var('cat');
  $category = get_term_by('id', $term_id, 'category');

$current_page = (get_query_var('paged')) ?: 1;
$per_page = get_option('posts_per_page');
// Or: $per_page = Post::getPostsPerPage();

// This is already a single page of results
$category_posts = \Taco\Post\Factory::createMultiple($posts);

$total_posts = $category->count;
echo Util::getPagination($current_page, $total_posts, array(
  'per_page' => $per_page,
  'link_prefix' => '/category/'.$category->slug,
));
