function split_nav_into_columns($child_page_ids, $num_cols=2) {
  global $post;
  
  if($child_page_ids) {
    $html = '';
    while($num_cols > 0) {
      $items_per_col = ceil(count($child_page_ids) / $num_cols);
      $html .= '<ul>';
      for($i = 0; $i < $items_per_col; $i++) {
        $cp = array_shift($child_page_ids);
        $p = get_post($cp);
        $active = $cp == $post->ID ? 'active' : '';
        $ancestor = in_array($cp, get_ancestors($post->ID, 'page')) ? ' ancestor' : '';
        $html .= '<li class="'.$active.$ancestor.'"><a href="'.get_permalink($cp).'">'.$p->post_title.'</a></li>';
      }
      $html .= '</ul>';
      $num_cols--;
    }
    return $html;
  }
}
