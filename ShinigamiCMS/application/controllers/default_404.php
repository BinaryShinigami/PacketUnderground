<?php

class Default_404 extends ShinigamiCMS\System\Core\Objectbase {
    
    public function Index() {
        return '404 -- Page ' . $_SERVER['PHP_SELF'] . ' Not Found ^_^';
    }
    
}


?>
