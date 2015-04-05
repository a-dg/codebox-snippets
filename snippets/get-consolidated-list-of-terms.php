// display consolidated list of keywords used on research for this focus area
$all_keywords = array();
$consolidated_keywords = array();

foreach($research_items as $ri) {
  $all_keywords[] = $ri->getTerms('keyword');
}
foreach($all_keywords as $post_keywords) {
  foreach($post_keywords as $keywords) {
    $consolidated_keywords[] = $keywords;
  }
}

// can't just use array_unique because it's full of objects, i guess
$consolidated_keywords = array_map('unserialize', array_unique(array_map('serialize', $consolidated_keywords)));

if(Arr::iterable($consolidated_keywords)) {
  echo '<h3>Keywords</h3><p>';
  $keyword_list = array();
  foreach($consolidated_keywords as $keyword) {
    $keyword_list[] = '<a href="'.URL_RESEARCH_DATABASE.'#'.$keyword->term_id.'">'.$keyword->name.'</a>';
  }
  echo implode(', ', $keyword_list);
  echo '</p>';
}
