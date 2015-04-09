$term = \Taco\Term\Factory::create(get_queried_object());

$current_page = (get_query_var('paged')) ?: 1;
$per_page = get_option('posts_per_page');
// Or: $per_page = NewsPost::getPostsPerPage();

$term_posts = NewsPost::getByTerm(
  $term->taxonomy,
  $term->slug,
  'slug',
  array(
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => $per_page,
    'offset' => ($current_page - 1) * $per_page
  )
);

$total_posts = NewsPost::getCountByTerm(
  $term->taxonomy,
  $term->slug,
  'slug'
);
echo Util::getPagination($current_page, $total_posts, array(
  'per_page' => $per_page,
  'link_prefix' => '/news/'.$term->slug,
));
