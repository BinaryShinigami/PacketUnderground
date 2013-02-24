<?php
/** This file is just a boiler plate script to streamline the loading of smarty the
 * smarty template engine into ShinigamiCMS
 * 
 * @package ShinigamiCMS\System\Libraries
 * @author Shane McIntosh (BinaryShinigami)
 * 
 */


use ShinigamiCMS\System\Core\Registry;
$registry = &Registry::get_instance();
require_once($registry->system_dir . 'libraries/Smarty/Smarty.class.php');

/* End of smarty.php */