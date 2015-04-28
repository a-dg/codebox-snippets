// Display consolidated list of keywords used on research for this focus area
$all_keywords = array();
$consolidated_keywords = array();

// Add to new array without unwanted keys
// foreach($taxonomy as $tax) {
  // object_id is always unique and prevents us from removing duplicates
  // term_order is unused
  // unset($tax->object_id);
  // unset($tax->term_order);
  // $tags[] = $tax;
// }

foreach($research_items as $ri) {
  $all_keywords[] = $ri->getTerms('keyword');
}
foreach($all_keywords as $post_keywords) {
  foreach($post_keywords as $keywords) {
    $consolidated_keywords[] = $keywords;
  }
}

if(Arr::iterable($consolidated_keywords)) {
  usort($consolidated_keywords, function($a, $b){
    return strnatcasecmp($a->name, $b->name);
  });
  
  // Serialized arrays are treated as strings to remove duplicates
  $consolidated_keywords = array_map('unserialize', array_unique(array_map('serialize', $consolidated_keywords)));
  
  $keyword_list = array();
  foreach($consolidated_keywords as $keyword) {
    $keyword_list[] = '<a href="'.URL_RESEARCH_DATABASE.'#'.$keyword->term_id.'">'.$keyword->name.'</a>';
  }
  echo sprintf(
    '<h3>Keywords</h3>
    <p>%s</p>',
    join(', ', $keyword_list)
  );
}
