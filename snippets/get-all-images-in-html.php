preg_match_all('/(<img.*?src=.([\/.a-z0-9:_-]+).*?>)/si', $html, $matches);
$i = 0;
$paths = array();

foreach($matches[1] as $img_tag) {
  if(preg_match("/$exclude_string/", $img_tag)) continue;
  $html = str_replace($img_tag, '', $html);
}

foreach($matches[2] as $img) {
  $img_old = $img;
  
  if(strpos($img, 'http://') === false) {
    $uri = parse_url($img);
    $paths[$i]['path'] = $_SERVER['DOCUMENT_ROOT'].$uri['path'];
    $content_id = md5($img);
    $html = str_replace($img_old, 'cid:'.$content_id, $html);
    $paths[$i++]['cid'] = $content_id;
  }
}