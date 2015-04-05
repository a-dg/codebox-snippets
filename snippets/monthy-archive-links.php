echo sprintf(
  '<ul>
    %s
  </ul>'
  wp_get_archives(array('type'=>'monthly', 'limit'=>6))
);