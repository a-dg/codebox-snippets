$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
if(strpos($user_agent, 'windows') !== false) {
  echo sprintf(
    '<link rel="stylesheet" type="text/css" media="all" href="%s/css/windows.css">',
    get_template_directory_uri()
  );
}