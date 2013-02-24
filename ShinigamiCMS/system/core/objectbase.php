<?php

/*
 * This file contains the code that is used as the base of all objects that
 * users can create.
 * 
 * @author Shane McIntosh (BinaryShinigami)
 * @package ShinigamiCMS/System/Core
 */

namespace ShinigamiCMS\System\Core;
use ShinigamiCMS\System\Core\Registry;

class Objectbase {
    private $registry = NULL;
    
    /**
     * This is the default constructor for ALL objects, if an object
     * creates their own constructor they must call this constructor via
     * parent::__construct() to ensure this functionality exists.
     */
    public function __construct() {
    
        $this->registry &= Registry::get_instance();
        
    }
    
    public function __get($key) {
        return $this->registry->get($key);
    }
    
}

/* End of objectbase.php */
