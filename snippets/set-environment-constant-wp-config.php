// In wp-config.php:
require_once __DIR__.'/environment.php';
switch(ENVIRONMENT) {
  case ENVIRONMENT_LOCAL:
    define('DB_USER',     'root');
    define('DB_PASSWORD', 'root');
    define('DB_HOST',     'localhost');
    define('DB_NAME',     'wordpress');
    define('SAVEQUERIES', true);
    break;
  
  case ENVIRONMENT_STAGE:
    // Etc
    
}