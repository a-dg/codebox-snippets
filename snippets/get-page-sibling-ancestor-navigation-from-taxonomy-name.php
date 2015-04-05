$taxonomy = reset($post->getTerms('taxonomy'));
$taxonomy_title = $taxonomy->name;
$matching_page = get_page_by_title($taxonomy_title);
$page_id = $matching_page->ID;
get_page_nav($page_id)