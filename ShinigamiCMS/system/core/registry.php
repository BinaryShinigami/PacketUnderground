<?php

/*
 * This file contains code that relates to the global ojbect registry implementation in
 * ShinigamiCMS. The Registry Class is a singleton and as such there should only be 
 * a single instance of it to save memory.
 * 
 * @author Shane McIntosh (BinaryShinigami)
 * @package ShinigamiCMS\System\Core
 */

namespace ShinigamiCMS\System\Core;

class Registry {
    
    public static $class_instances = array();
    
    public static $registry_instance = NULL;
    
    public static function &get_instance() {
    
        if (Registry::$registry_instance) {
            return Registry::$registry_instance;
        }
        
        Registry::$registry_instance = new Registry();
        return Registry::$registry_instance;
        
    }
    
    public function __get($key) {
        if (array_key_exists($key, Registry::$class_instances)) {
            return Registry::$class_instances[$key];
        }
        else {
            return NULL;
        }
    }
    
    public function __set($key, $value) {
        Registry::$class_instances[$key] = $value;
    }
    
}

/* End of registry.php */
