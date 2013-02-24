<?php

/**
 * This file contains code related to security.
 * 
 * @author Shane McIntosh (BinaryShinigami)
 * @package ShinigamiCMS\System\Utils
 */

namespace ShinigamiCMS\System\Utils;

/**
 * This class is a singleton and should not be instantiated directly. Instead
 * utilize the get_instance() function to get the object.
 * 
 * @return Object
 */
class Security {
    
    public static $instance = NULL;

    
    public static function &get_instance() {
        if ( Security::$instance ) {
            
            return Security::$instance;
            
        }
        
        Security::$instance = new Security();
        return Security::$instance;
        
    }
    
    public function sanitize_file_uri($URI) {
        return str_replace('./', '', $URI);
    }
    
    
}


/* End of security.php */
