function get_phone_link($tel) {
  $tel_link = preg_replace('/\D/', '', $tel);
  $tel_link = (substr($tel_link, 0, 1) !== '1') ? '1'.$tel_link : $tel_link;
  return '<a href="tel:+'.$tel_link.'">'.$tel.'</a>';
}
