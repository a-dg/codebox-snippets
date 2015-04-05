// The 'paged' query variable tell you what the current page number is anywhere on the site
$current_page = (get_query_var('paged')) ?: 1;

// 'paged' changes to 'page' on a static front page
$current_page = (get_query_var('page')) ?: 1;