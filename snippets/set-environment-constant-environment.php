// environment.php:

// Determine the environment if not already defined
if(!defined('ENVIRONMENT_LOCAL')) define('ENVIRONMENT_LOCAL', 'local');
if(!defined('ENVIRONMENT_STAGE')) define('ENVIRONMENT_STAGE', 'stage');
if(!defined('ENVIRONMENT_PROD'))  define('ENVIRONMENT_PROD', 'prod');

// If you haven't explicitly defined the environment already,
// we will figure it out.
if(!defined('ENVIRONMENT')) {
  // Normal web request
  if(array_key_exists('HTTP_HOST', $_SERVER)) {
    if(preg_match('/(localhost|10\.0\.1|\.dev|\.local)/', $_SERVER['HTTP_HOST'])) {
      define('ENVIRONMENT', ENVIRONMENT_LOCAL);
    } elseif(preg_match('/(\.vermilion\.com)/', $_SERVER['HTTP_HOST'])) {
      define('ENVIRONMENT', ENVIRONMENT_STAGE);
    } else {
      define('ENVIRONMENT', ENVIRONMENT_PROD);
    }
  }
  
  // Terminal/command line
  elseif(PHP_SAPI === 'cli') {
    
  }
}