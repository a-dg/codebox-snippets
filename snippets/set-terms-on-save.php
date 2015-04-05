if($auto_generate) {
  $autogen_term = reset(get_terms('status', array('include'=>$term_id)));
  $all_terms['status'][$term_id] = $autogen_term;
} elseif($auto_generate === false) {
  $all_terms['status'][$term_id] = null;
}

foreach($all_terms as $taxonomy => $terms) {
  foreach($terms as $key => $term) {
    if(is_null($term)) {
      unset($terms[$key]);
    }
  }
  $this->setTerms(array_keys($terms), $taxonomy);
}
