<?php
get_header();
$theme = ThemeOption::getInstance();
$term = \Taco\Term\Factory::create(get_queried_object());
?>

<div id="content">
  <h1><?php echo $term->name; ?></h1>
  <p><?php echo $term->description; ?></p>
  <?php
  echo Util::getHierarchicalTermList($term->taxonomy, $term->term_id, $term->parent);
  
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
  
  if(Arr::iterable($term_posts)) {
    foreach($term_posts as $term_post) {
      echo sprintf(
        '<article>
          <h2><a href="%s">%s</a></h2>
          <p class="date">%s</p>
          %s
        </article>',
        $term_post->getPermalink(),
        $term_post->getTheTitle(),
        mysql2date('F j, Y', $term_post->post_date),
        $term_post->getTheExcerpt()
      );
    }
  }
  
  $total_posts = NewsPost::getCountByTerm(
    $term->taxonomy,
    $term->slug,
    'slug'
  );
  echo Util::getPagination($current_page, $total_posts, array(
    'per_page' => $per_page,
    'link_prefix' => '/news/'.$term->slug,
  ));
  ?>
</div>

<?php get_footer(); ?>