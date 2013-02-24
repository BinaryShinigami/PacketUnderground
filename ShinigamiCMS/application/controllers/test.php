<?php


class Test extends ShinigamiCMS\System\Core\Objectbase {
    
    public function Index($username = "Shane") {
        $this->a = 1;
        if ($this->loader->load_library('blog_layout')) {
            return $this->blog_layout->render_page('<p>This is a sample Test Page<p>');
        }
        else {
            return "Error Loading Library?!";
        }
    }
}

?>
