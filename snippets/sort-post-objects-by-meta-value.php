usort($staff_members, function($a, $b){
  return ((int) $a->weight > (int) $b->weight) ? 1 : -1;
});