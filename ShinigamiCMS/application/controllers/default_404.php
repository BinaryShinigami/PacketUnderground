<?php

class Default_404 extends ShinigamiCMS\System\Core\Objectbase {
    
    public function Index() {
        $message = '<h2 align=\'center\'>Sorry but the page specified couldn\' be found on our server!</h2>';
        
        return $this->blog_layout->render_page($message);
    }
    
}


?>
