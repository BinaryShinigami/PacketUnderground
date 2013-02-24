<?php

/**
 * This is the main routing file for the Shinigami CMS.
 * DO NOT CHANGE THIS file below the SYSTEM_DIR and APP_DIR defines
 * 
 * @package ShinigamiCMS
 * @author Shane McIntosh (BinaryShinigami)
 */

namespace ShinigamiCMS;

$system_dir = '/home/dev.packetunderground.com/webroot/ShinigamiCMS/system/'; 
$app_dir = '/home/dev.packetunderground.com/webroot/ShinigamiCMS/application/';
define(DEFAULT_CONTROLLER, 'default_controller');

require_once($system_dir . 'core/routing.php');
require_once($system_dir . 'utils/security.php');
require_once($system_dir . 'core/registry.php');
use ShinigamiCMS\System\Core\Routing;
use ShinigamiCMS\System\Utils\Security;
use ShinigamiCMS\System\Core\Registry;

$router = new Routing();
$registry = &Registry::get_instance();
$registry->security = Security::get_instance();


$URL = $registry->security->sanitize_file_uri( $_SERVER['PHP_SELF'] );
if ( substr( $URL, 0, 10) == '/index.php' ) {
    $URL = substr($URL, 11);
}

$URL = rtrim($URL, "/");

$results = $router->route_url($app_dir, $URL);
if (!$results) {
    //HANDLE 404 here
    echo '<html><body><h1 align="center">404</h1></body></html>';
}
else {
    echo $results;
}

?>
