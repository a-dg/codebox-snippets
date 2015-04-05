// At the top of header.php:
if(ENVIRONMENT === ENVIRONMENT_LOCAL) {
  ob_start();
}

// At the bottom of footer.php:
if(ENVIRONMENT === ENVIRONMENT_LOCAL) {
  $html = ob_get_clean();
  $html = str_replace('localhost:8888', $_SERVER['HTTP_HOST'], $html);
  echo $html;
}
