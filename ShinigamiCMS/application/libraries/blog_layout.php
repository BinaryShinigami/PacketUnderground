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
        
    }
    
    public function render_page($content, $sidebars = 0, $template = 'packetunderground/base.tpl') {
        $this->smarty->assign('data', $content);
        
        if (!$sidebars) {
            $sidebars = $this->config->Sidebar['Items'];
        }
        
        $this->smarty->assign('sideitems', $sidebars);
        
        $this->smarty->setTemplateDir($this->app_dir . 'views/');
        return $this->smarty->fetch($template);
    }
    
    public function render_blog_post_form($fields) {
        $this->smarty->assign('post', $fields);
        $sidebars = $this->config->Sidebar['Items'];
        $this->smarty->assign('sideitems', $sidebars);
        $this->smarty->setTemplateDir($this->app_dir . 'views/');
        return $this->smarty->fetch('packetunderground/admin_post.tpl');
    }
    
    public function render_front_page($blog_posts) {
        $sidebar = $this->config->Sidebar['Items'];
        
        $this->smarty->setTemplateDir($this->app_dir . 'views/');
        
        $this->smarty->assign('posts', $blog_posts);
        $this->smarty->assign('sideitems', $sidebar);
        
        return $this->smarty->fetch('packetunderground/front_page.tpl');
        
    }
    
    public function render_post($post) {
        
        $this->smarty->setTemplateDir($this->app_dir . 'views/');
        
        $side = $this->config->Sidebar['Items'];
        $this->smarty->assign('sideitems', $side);
        
        $this->smarty->assign('post', $post);
        return $this->smarty->fetch('packetunderground/single_post.tpl');
        
    }
    
}

/* End of blog_layout.php */
