<?php


class Test extends ShinigamiCMS\System\Core\Objectbase {
    
    public function Index() {
        if ($this->loader->load_library('blog_layout')) {
            return $this->blog_layout->render_front_page();
        }
        else {
            return "Error Loading Library?!";
        }
    }
    
    public function Test_config() {
        //require_once($this->app_dir . 'models/blog_user.php');
        if ($this->loader->load_library('config')) {
            $output = 'Database Config Contents: <br />';
            $output .= $this->config->Database['Hostname'] . '<br />';
            $output .= $this->config->Database['Username'] . '<br /><br />';
            $output .= 'CMS version: ' . $this->config->cms_version . '<br /><br />';
            /*$output .= 'Declared Classes: <br />';
            $classes = get_declared_classes();
            foreach ($classes as $class) {
                $output .= $class . '<br />';
            }*/
            
            return $output;
        }
        else {
            return 'Error Loading Config Library!';
        }
    }
}

?>
