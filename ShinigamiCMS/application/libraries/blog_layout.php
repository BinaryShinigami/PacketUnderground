<?php

/*
 * This class contains a Templating wrapper for easily working with the PU Layout.
 * 
 * @author Shane McIntosh
 * @package PacketUnderground
 */

namespace PacketUnderground\Libraries;
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
    
    public function render_page($content, $template = 'packetunderground/base.tpl') {
        $this->smarty->assign('data', $content);
        $this->smarty->assign('sideitems', $this->temp_sidebars);
        
        return $this->smarty->fetch($template);
    }
    
    public function render_front_page($blog_posts) {
        
        $posts_temp = array(
            array(
                'title' => 'Test Post',
                'author' => 'Shane McIntosh',
                'timestamp' => 'Feb 26 2013',
                'content' => 'This is just garbagey stupid filler content. Enjoy it while it lasts! This is just garbagey stupid filler content. Enjoy it while it lasts! This is just garbagey stupid filler content. Enjoy it while it lasts! This is just garbagey stupid filler content. Enjoy it while it lasts!',
                'comment_uri' => '#',
                'comment_count' => '0'
            ),
            array(
                'title' => 'Test Post',
                'author' => 'Shane McIntosh',
                'timestamp' => 'Feb 26 2013',
                'content' => 'This is just garbagey stupid filler content. Enjoy it while it lasts! This is just garbagey stupid filler content. Enjoy it while it lasts! This is just garbagey stupid filler content. Enjoy it while it lasts! This is just garbagey stupid filler content. Enjoy it while it lasts!',
                'comment_uri' => '#',
                'comment_count' => '0'
            ),
            array(
                'title' => 'Test Post',
                'author' => 'Shane McIntosh',
                'timestamp' => 'Feb 26 2013',
                'content' => 'This is just garbagey stupid filler content. Enjoy it while it lasts! This is just garbagey stupid filler content. Enjoy it while it lasts! This is just garbagey stupid filler content. Enjoy it while it lasts! This is just garbagey stupid filler content. Enjoy it while it lasts!',
                'comment_uri' => '#',
                'comment_count' => '0'
            ),
            array(
                'title' => 'Test Post',
                'author' => 'Shane McIntosh',
                'timestamp' => 'Feb 26 2013',
                'content' => 'This is just garbagey stupid filler content. Enjoy it while it lasts! This is just garbagey stupid filler content. Enjoy it while it lasts! This is just garbagey stupid filler content. Enjoy it while it lasts! This is just garbagey stupid filler content. Enjoy it while it lasts!',
                'comment_uri' => '#',
                'comment_count' => '0'
            ),
            array(
                'title' => 'Test Post',
                'author' => 'Shane McIntosh',
                'timestamp' => 'Feb 26 2013',
                'content' => 'This is just garbagey stupid filler content. Enjoy it while it lasts! This is just garbagey stupid filler content. Enjoy it while it lasts! This is just garbagey stupid filler content. Enjoy it while it lasts! This is just garbagey stupid filler content. Enjoy it while it lasts!',
                'comment_uri' => '#',
                'comment_count' => '0'
            ),
        );
        
        $this->smarty->assign('posts', $posts_temp);
        $this->smarty->assign('sideitems', $this->temp_sidebars);
        
        return $this->smarty->fetch('packetunderground/front_page.tpl');
        
    }
    
}

/* End of blog_layout.php */
