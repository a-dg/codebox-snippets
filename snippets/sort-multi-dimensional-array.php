// new array
$tags = array();

// add to new array without unwanted keys
foreach($taxonomy as $tax) {
  // object_id's are always unique and prevent us from removing duplicates
  // term_order is unused
  unset($tax->object_id);
  unset($tax->term_order);
  $tags[] = $tax;
}

// sort by user-defined method
usort($tags, 'sort_tags_by_name');

// serialized arrays are treated as strings to remove duplicates
$tags_unique = array_map('unserialize', array_unique(array_map('serialize', $tags)));

// sorting function
function sort_tags_by_name($a, $b) {
  // strcmp is case sensitive
  // strnatcasecmp is case insensitive
  // $x->name is the key to use for sorting
  return strnatcasecmp($a->name, $b->name);
}
