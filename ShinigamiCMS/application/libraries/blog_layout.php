<?php

/*
 * This class contains a Templating wrapper for easily working with the PU Layout.
 * 
 * @author Shane McIntosh
 * @package PacketUnderground
 */

use \ShinigamiCMS\System\Core\Objectbase;

class Blog_layout extends Objectbase {
    
    private $temp_sidebars = NULL;
    
    public function __construct() {
        
        parent::__construct();
        
        $this->loader->load_library('smarty');
        $this->smarty->setTemplateDir($this->app_dir . 'views/');
        $this->temp_sidebars = array(
        array(
            'title' => 'Navigation',
            'links' => array(
                array(
                    'title' => 'Home',
                    'uri' => '/'
               ),
                array(
                    'title' => 'voooid',
                    'uri' => 'http://voooid.com/'
               ),
                array(
                    'title' => 'Google',
                    'uri' => 'http://google.com'
               )
            )
        )
        
    );
    }
    
    public function render_page($content) {
        $this->smarty->assign('data', $content);
        $this->smarty->assign('sideitems', $this->temp_sidebars);
        
        return $this->smarty->fetch('packetunderground/base.tpl');
    }
    
}

/* End of blog_layout.php */
