<?php

/**
 * This is the main routing file for the Shinigami CMS.
 * DO NOT CHANGE THIS file below the SYSTEM_DIR and APP_DIR defines
 * 
 * @package ShinigamiCMS
 * @author Shane McIntosh (BinaryShinigami)
 */

namespace ShinigamiCMS;

/**
 * If you wish to move index.php simply replace the following 2 vars with the 
 * location of your system/ and application directories and DON'T FORGET THE
 * TRAILING SLASH AT THE END!!!!!
 */
$system_dir = 'system/'; 
$app_dir = 'application/';

/** This line defines the default controller that will be used when none is specified. */
define(DEFAULT_CONTROLLER, 'blog');
define(DEFAULT_404, 'default_404'); //Leave blank for default!

/** DO NOT MODIFY BELOW THIS LINE UNLESS YOU KNOW WHAT YOU ARE DOING THESE ARE 
 * NOT CONFIGURATION ITEMS!!!!
 * <-------------------------------------------------------------------------->
 */

session_start();

require_once($system_dir . 'core/routing.php');
require_once($system_dir . 'utils/security.php');
require_once($system_dir . 'core/registry.php');
require_once($system_dir . 'core/object_base.php');
require_once($system_dir . 'core/object_loader.php');
require_once($system_dir . 'core/helper_functions.php');
require_once($system_dir . 'libraries/config.php');
require_once($app_dir . 'config/auto_loader.php');
use ShinigamiCMS\System\Core\Routing;
use ShinigamiCMS\System\Utils\Security;
use ShinigamiCMS\System\Core\Registry;
use ShinigamiCMS\System\Core\Objectloader;
use ShinigamiCMS\System\Libraries\Config;

//Setup the registry with some important data.
$router = new Routing();
$registry = &Registry::get_instance();
$registry->router = $router;
$registry->security = Security::get_instance();
$registry->system_dir = $system_dir;
$registry->app_dir = $app_dir;
$registry->loader = Objectloader::get_instance();
$registry->config = Config::get_instance();
$registry->config->load_config_files();

foreach ($auto_models as $model) {
    $registry->loader->load_model($model);
}

foreach ($auto_libraries as $lib) {
    $registry->loader->load_library($lib);
}

$URL = $registry->security->sanitize_file_uri( $_SERVER['PHP_SELF'] );
if ( substr( $URL, 0, 10) == '/index.php' ) {
    $URL = substr($URL, 11);
}

$URL = rtrim($URL, "/");

// This is a neat trick, if we want to generate a 404 we simply return False from the controller.
$results = $router->route_url($app_dir, $URL);
if (!$results) {
    //HANDLE 404 here
    if ( strlen(DEFAULT_404) > 0) {
        $results = $router->route_url($app_dir, DEFAULT_404);
    }
    else {
        $results = '<html><body><h1 align="center">404 Page Not Found</h1></body></html>';
    }
}    
echo $results;

?>
