function split_into_columns($array, $num_cols=2) {
  if($array) {
    $html = '';
    while($num_cols > 0) {
      $items_per_col = ceil(count($array) / $num_cols);
      $html .= '<ul>';
      for($i = 0; $i < $items_per_col; $i++) {
        $cp = array_shift($array);
        $html .= '<li>'.$cp.'</li>';
      }
      $html .= '</ul>';
      $num_cols--;
    }
    return $html;
  }
}
