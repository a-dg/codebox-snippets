// Cache busting
define('THEME_VERSION', (ENVIRONMENT !== ENVIRONMENT_DEV) ? mt_rand() : (int) preg_replace('/((?:.*)\$version\:\s+(\d+);(?:.*))/si', '$2', file_get_contents(dirname(__FILE__).'/scss/_main.scss')));
define('THEME_SUFFIX', sprintf('?v=%s', THEME_VERSION));