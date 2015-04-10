<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
<?php
$template_dir = get_template_directory_uri();
$sizes = array(
  '', // 57 x 57
  '57x57',
  '72x72',
  '76x76',
  '114x114',
  '120x120',
  '144x144',
  '152x152',
);
foreach($sizes as $size) {
  $sizes_attr = (strlen($size))
    ? 'sizes="'.$size.'"'
    : null;
  $size_suffix = (strlen($size))
    ? '-'.$size
    : null;
  echo sprintf(
    '<link rel="apple-touch-icon" %s href="%s/img/apple-touch-icon%s.png%s">',
    $sizes_attr,
    $template_dir,
    $size_suffix,
    THEME_SUFFIX
  );
}
?>