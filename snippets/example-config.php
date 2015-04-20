// Cache busting
define('THEME_VERSION', (ENVIRONMENT !== ENVIRONMENT_DEV) ? mt_rand() : (int) preg_replace('/((?:.*)\$version\:\s+(\d+);(?:.*))/si', '$2', file_get_contents(dirname(__FILE__).'/scss/_main.scss')));
define('THEME_SUFFIX', sprintf('?v=%s', THEME_VERSION));

// Column classes
define('COLUMNS_CONTENT', 'columns average-8');
define('COLUMNS_SIDEBAR', 'columns average-4');
define('COLUMNS_CENTERED', 'small-8 medium-6 average-12 small-offset-2 medium-offset-3 average-offset-0');

// Get request protocol
$protocol = (
  (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
  || $_SERVER['SERVER_PORT'] == 443
) ? 'https' : 'http';

// URLs
define('URL_BASE', sprintf('%s://%s', $protocol, $_SERVER['HTTP_HOST']));
define('URL_REQUEST', URL_BASE.$_SERVER['REQUEST_URI']);
define('URL_NEWS', '/news/');
define('URL_RESOURCE_LIBRARY', '/research-tools/resource-library/');

// User logged in/out classes are also in main.js
define('USER_LOGGED_IN_CLASS', 'user-logged-in');
define('USER_LOGGED_OUT_CLASS', 'user-logged-out');

// Text
define('TEXT_FIELD_STYLE', 'width: 100%;');
define('LINE_BREAKS', serialize(array("</p>\n<p>", "\r\n", "\n", "\r", '<br>', '<br />')));

// Post IDs
define('POST_ID_EVENTS', 49542);
define('POST_ID_BOARD_OF_DIRECTORS', 49616);
define('POST_ID_STAFF', 49617);