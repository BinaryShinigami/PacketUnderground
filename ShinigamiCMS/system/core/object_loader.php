<?php

/*
 * This file contains code for the ObjectLoader class that loads objects
 * dynamically when requested.
 * 
 * @author Shane McIntosh (BinaryShinigami)
 * @package ShinigamiCMS\System\Core
 */

namespace ShinigamiCMS\System\Core;
use ShinigamiCMS\System\Core\Objectbase;

class Objectloader extends Objectbase {
    
    public static $instance = NULL;
    
    public static function &get_instance() {
        if (Objectloader::$instance) {
            return Objectloader::$instance;
        }
        
        Objectloader::$instance = new Objectloader();
        return Objectloader::$instance;
    }
    
    /**
     * Loads the model object specified from the filesystem into the global registry, first looking in the 
     * application/models/ folder and if not found then looking in the system/models/ folder.
     * 
     * Returns True on success or False on Failure
     * 
     * @param string $modelname
     * @return boolean
     */
    public function load_model($modelname) {
        if ( file_exists( $this->app_dir . 'models/' . $modelname . '.php' ) ) {
            require_once( $this->app_dir . 'models/' . $modelname . '.php');
            
            $cap_modelname = ucfirst($modelname);
            $namelen = strlen($cap_modelname);
            $loaded_classes = get_declared_classes();
            foreach ($loaded_classes as $class) {
                if (substr($class, -($namelen)) == $cap_modelname) {
                    $cap_modelname = $class;
                }
            }
            if (! class_exists($cap_modelname)) {
                return False;
            }
            Registry::$class_instances[$modelname] =  new $cap_modelname();
            return True;
        }
        elseif ( file_exists( $this->system_dir . 'models/' . $modelname . '.php' ) ) {
            
            require_once( $this->system_dir . 'models/' . $modelname . '.php');
            
            $cap_modelname = ucfirst($modelname);
            $namelen = strlen($cap_modelname);
            $loaded_classes = get_declared_classes();
            foreach ($loaded_classes as $class) {
                if (substr($class, -($namelen)) == $cap_modelname) {
                    $cap_modelname = $class;
                }
            }
            if (! class_exists($cap_modelname)) {
                return False;
            }
            Registry::$class_instances[$modelname] =  new $cap_modelname();
            return True;
            
        }
        else {
            return False;
        }
    }
    

    /**
     * Loads the library object specified from the filesystem into the global registry, first looking in the 
     * application/libraries/ folder and if not found then looking in the system/libraries/ folder.
     * 
     * Returns True on success or False on Failure
     * 
     * @param string $modelname
     * @return boolean
     */
    public function load_library($libname) {
        $filepath = $this->app_dir . 'libraries/' . $libname . '.php';
        if ( file_exists( $filepath ) ) {
            require_once( $filepath );
            
            $cap_libname = ucfirst($libname);
            $namelen = strlen($cap_libname);
            $loaded_classes = get_declared_classes();
            foreach ($loaded_classes as $class) {
                if (substr($class, -($namelen)) == $cap_libname) {
                    $cap_libname = $class;
                }
            }
            if (! class_exists($cap_libname)) {
                return False;
            }
            $tobj = new $cap_libname();
            Registry::$class_instances[$libname]= $tobj;
            return True;
        }
        else
        {
            $filepath = $this->system_dir . 'libraries/' . $libname . '.php';
            if ( file_exists( $filepath ) ) {

                require_once( $filepath );

                $cap_libname = ucfirst($libname);
                $namelen = strlen($cap_libname);
                $loaded_classes = get_declared_classes();
                foreach ($loaded_classes as $class) {
                    if (substr($class, -($namelen)) == $cap_libname) {
                        $cap_libname = $class;
                    }
                }
                if (! class_exists($cap_libname)) {
                    return False;
                }
                $tobj = new $cap_libname();
                Registry::$class_instances[$libname]= $tobj;
                return True;

            }
            else {
                return False;
            }
        }
    }
    
}

/* End of Loader.php */