/**
 * Split array into rendered columns
 * @param array $array
 * @param int $num_columns
 * @param string $columns_class
 * @return string
 */
public static function splitIntoColumns($array, $num_columns=2, $columns_class='small-6') {
  if(!Arr::iterable($array)) return null;
  
  $columns = array();
  $groups = Arr::apportion($array, $num_columns);
  foreach($groups as $group) {
    $group_items = array();
    foreach($group as $item) {
      $group_items[] = '<li>'.$item.'</li>';
    }
    $columns[] = sprintf(
      '<div class="columns %s">
        <ul>
          %s
        </ul>
      </div>',
      $columns_class,
      join("\n", $group_items)
    );
  }
  return sprintf(
    '<div class="row">
      %s
    </div>',
    join("\n", $columns)
  );
}


/**
 * Split array into rendered columns
 * @param array $array
 * @param int $num_columns
 * @param string $columns_class
 * @param bool $use_full_row
 * @param string $insert_between
 * @param int $steal
 * @return string
 */
public static function splitIntoColumnsOriginal($array, $num_columns=2, $columns_class='small-6', $use_full_row=true, $insert_between=null, $steal=0) {
  if(!Arr::iterable($array)) return null;
  
  $columns = array();
  while($num_columns > 0) {
    $items_per_column = ceil(count($array) / $num_columns);
    $last_column_class = ($num_columns === 1 && !$use_full_row)
      ? ' end'
      : null;
    $items_per_column_adjusted = ($num_columns === 1)
      ? count($array)
      : $items_per_column - $steal;
    
    $group_items = array();
    for($i = 0; $i < $items_per_column_adjusted; $i++) {
      $item = array_shift($array);
      $group_items[] = '<li>'.$item.'</li>';
    }
    
    $columns[] = sprintf(
      '<div class="columns %s%s">
        <ul class="clearfix">
          %s
        </ul>
        %s
      </div>',
      $columns_class,
      $last_column_class,
      join("\n", $group_items),
      ($num_columns !== 1) ? $insert_between : null
    );
    
    $num_columns--;
  }
  
  return sprintf(
    '<div class="row">
      %s
    </div>',
    join("\n", $columns)
  );
}