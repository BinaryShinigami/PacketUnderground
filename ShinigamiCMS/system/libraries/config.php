<?php

/**
 * This file contains an easy to use Configuration File Loader and Accessor.
 * 
 * @author Shane McIntosh (BinaryShinigami)
 * @package ShinigamiCMS\System\Libraries
 */

namespace ShinigamiCMS\System\Libraries;
use ShinigamiCMS\System\Core\Objectbase;

class Config extends Objectbase {
    public static $obj_instance = NULL;
    public static $reg_obj = array('ShinigamiCMS' => '1');
   
    public static function &get_instance() {
        if ( Config::$obj_instance ) {
            return Config::$obj_instance;
        }
        
        Config::$obj_instance = new Config();
        Config::$reg_obj['Test'] = 1;
        
        return Config::$obj_instance;
    }
    
    public function __construct() {
        
        if (Config::$obj_instance) {
            return Config::$obj_instance;
        }
        
        parent::__construct();
        
    }
    
    public function __get($key) {
        
        if (array_key_exists($key, Config::$reg_obj)) {
            return Config::$reg_obj[$key];
        }
        
        return parent::__get($key);
        
    }
    
    public function __set($key, $value) {
        Config::$reg_obj[$key] = $value;
    }
    
    private function get_app_file_list() {
        $config_dir = $this->app_dir . 'config/';
        $files = glob($config_dir . '*.php');
        return $files;
    }
    
    public function load_config_files() {
        $file_list = $this->get_app_file_list();
        foreach($file_list as $file) {
            require_once($file);
            global $config;
            if (is_array($config))
                Config::$reg_obj = array_merge($config, Config::$reg_obj);
        }
    }
    
    
    
}

/* End of config.php */
