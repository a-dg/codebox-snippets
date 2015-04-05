$taxonomy_slug = 'news-type';
$term_slug = \Taco\Term\Factory::create(get_queried_object())->get('slug');

$current_page = (get_query_var('paged')) ?: 1;
$per_page = get_option('posts_per_page');
$per_page = NewsPost::getPostsPerPage();

$news_posts_of_this_type = NewsPost::getByTerm(
  $taxonomy_slug,
  $term_slug,
  'slug',
  array(
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => $per_page,
    'offset' => ($current_page - 1) * $per_page
  )
);

$total_posts = NewsPost::getCountByTerm(
  $taxonomy_slug,
  $term_slug,
  'slug'
);
echo Util::getPagination($current_page, $total_posts, array(
  'per_page' => $per_page,
  'link_prefix' => '/news/'.$term_slug,
));
