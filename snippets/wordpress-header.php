<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  
  <?php
  $page_title = null;
  if(is_tax()) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    $page_title = $term->name;
  } else {
    $page_title = wp_title(null, false);
  }
  $full_title = join(' | ', array_filter(array(
    $page_title,
    get_bloginfo('name')
  ), 'strlen'));
  echo '<title>'.$full_title.'</title>';
  ?>
  
  <?php // include __DIR__.'/incl-open-graph-meta.php'; ?>
  
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
  <?php
  $template_dir = get_template_directory_uri();
  $sizes = array(
    '',
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
      '<link rel="apple-touch-icon" %s href="%s/img/apple-touch-icon%s.png" />',
      $sizes_attr,
      $template_dir,
      $size_suffix
    );
  }
  ?>
  
  <?php
  // Get Windows CSS
  $browser = strtolower($_SERVER['HTTP_USER_AGENT']);
  if(strpos($browser, 'windows') !== false) {
    echo '<link rel="stylesheet" type="text/css" media="all" href="'.get_template_directory_uri().'/css/windows.css">';
  }
  ?>
  
  <?php wp_head(); ?>
  
  <!--[if lte IE 9]>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo get_template_directory_uri(); ?>/css/ie9.css">
  <![endif]-->
</head>
<?php flush(); ?>

<?php global $body_class; ?>
<body <?php body_class((isset($body_class)) ? $body_class : null); ?>>
<?php include __DIR__.'/incl-google-tag-manager.php'; ?>

<div id="skip-link"><a href="#content">Skip to Main Content</a></div>

<header role="banner">
  <div class="logo">
    <?php
    $site_title = 'Outdoor Industry Association';
    if(is_front_page()) {
      echo '<h1>'.$site_title.'</h1>';
    } else {
      echo '<a href="/">'.$site_title.'</a>';
    }
    ?>
  </div>
  <?php wp_nav_menu(array('theme_location'=>'menu_secondary', 'container'=>false)); ?>
</header>

<div id="main">