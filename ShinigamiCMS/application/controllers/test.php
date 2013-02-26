<?php


class Test extends ShinigamiCMS\System\Core\Objectbase {
    
    public function Index() {
        if ($this->loader->load_library('blog_layout')) {
            return $this->blog_layout->render_page('<p>This is a sample Test Page<p>');
        }
        else {
            return "Error Loading Library?!";
        }
    }
    
    public function Test_config() {
        if ($this->loader->load_library('config')) {
            $output = 'Database Config Contents: <br />';
            $output .= $this->config->Database['Hostname'] . '<br />';
            $output .= $this->config->Database['Username'] . '<br /><br />';
            $output .= 'CMS version: ' . $this->config->cms_version;
            
            return $output;
        }
        else {
            return 'Error Loading Config Library!';
        }
    }
}

?>
