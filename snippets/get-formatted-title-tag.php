$page_title = null;
if(is_tax()) {
  $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
  $page_title = $term->name;
} else {
  $page_title = wp_title(null, false);
}
$full_title = join(' | ', array_filter(array(
  $page_title,
  get_bloginfo('name')
), 'strlen'));
echo '<title>'.$full_title.'</title>';