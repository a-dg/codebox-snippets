function split_nav_into_columns_with_post(&$pp=null, $num_cols=2) {
  global $post;
  $pp = $pp ? $pp : $post;
  $child_page_ids = subnav($pp);
  
  if($child_page_ids) {
    $html = '';
    while($num_cols > 0) {
      $items_per_col = ceil(count($child_page_ids) / $num_cols);
      $html .= '<ul>';
      for($i = 0; $i < $items_per_col; $i++) {
        $cp = array_shift($child_page_ids);
        $p = get_post($cp);
        $active = $cp == $pp->ID ? 'active' : '';
        $ancestor = in_array($cp, get_ancestors($pp->ID, 'page')) ? ' ancestor' : '';
        $html .= '<li class="'.$active.$ancestor.'"><a href="'.get_permalink($cp).'">'.$p->post_title.'</a></li>';
      }
      $html .= '</ul>';
      $num_cols--;
    }
    return $html;
  }
}

function subnav(&$pp) {
  $ancestors = get_ancestors($pp->ID, 'page');
  $root_page = $ancestors ? array_pop($ancestors) : $pp->ID;
  $subnav = get_posts('post_type=page&numberposts=-1&orderby=menu_order&order=ASC&post_parent='.$root_page);
  
  if($subnav) {
    foreach($subnav as $sn) {
      $subnav_ids[] = $sn->ID;
    }
    return $subnav_ids;
  }
}