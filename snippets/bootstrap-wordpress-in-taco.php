// _bootstrap_wp.php
$install_dir = __DIR__.'/../../../../wordpress/';
chdir($install_dir);
include('wp-load.php');

// Usage
require_once __DIR__.'/../../../themes/app/_bootstrap_wp.php';
