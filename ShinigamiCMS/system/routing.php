<?php

/**
 * This file contains the URL Routing functionality for ShinigamiCMS.
 * DO NOT CHANGE THIS OR I WILL LIKLEY HUNT YOU DOWN AND SLAUGHTER YOU!.
 * 
 * @package ShinigamiCMS\System
 * @author Shane McIntosh (BinaryShinigami)
 */

namespace ShinigamiCMS\System;
use ShinigamiCMS;

class Routing {
    
     /**
     * Parses a URL and returns the Controller name and function name to call.
     * If the controller doesn't exist an error is logged and NULL is returned.
     *
     * 
     * @todo Add Logger
     * @param string $app_dir
     * @param string $URL
     * @return array
     */
    
    private function parse_url($app_dir, $URL) {
        
        $url_parts = explode('/', $URL, 3);

        //No Controller Specified. Load Default Controller
        if (strlen($url_parts[0]) == 0) {
            
            require_once($app_dir . 'controllers/' . DEFAULT_CONTROLLER . '.php');
            
            return array(
                'Controller' => DEFAULT_CONTROLLER,
                'Member' => 'Index',
                'Params' => array()
            );
        }
        
        $file_path = $app_dir . 'controllers/' . $url_parts[0] . '.php';
        
        if (file_exists( $file_path)) {
            
            require_once( $file_path );
            $c = new $url_parts[0]();
            $method = ucfirst($url_parts[1]);
            $params = explode("/", $url_parts[2]);
            if ((count(params) == 0) || (strlen($params[0]) == 0)) {
                $params = array();
            }
            if ( method_exists($c, $method) ) {
                return array( 
                    'Controller' => ucfirst($url_parts[0]),
                    'Member' => $method,
                    'Params' => $params ? $params : array()
                    );
            }
            else {
              
                $params = array_merge(array($url_parts[1], explode("/" . $url_parts[2])));
                if ((count(params) == 0) || (strlen($params[0]) == 0)) {
                    $params = array();
                }
                return array (
                    'Controller' => ucfirst($url_parts[0]),
                    'Member' => 'Index',
                    'Params' => $params ? $params : array()
                );
            }
        }
        //TODO Add Logger Here
        return NULL; //Failsafe
    }
    
    /**
     * Creates a Controller and Executes a function based on the path provided.
     * If the funtion doesn't exist we return False.
     * Returns the results of the function call.
     * 
     * @param string $app_dir
     * @param string $URL
     * @return Mixed
     */
    public function route_url($app_dir, $URL) {
        
        $exec_info = $this->parse_url($app_dir, $URL);
        
        if ($exec_info == NULL) {
            return False;
        }
        $cname = $exec_info['Controller'];
        $controller = new $cname();
        return call_user_func_array(array($controller, $exec_info['Member']), $exec_info['Params']);
    }
    
}

?>