<?php

use PacketUnderground\Models\Blog_user;

class Test extends ShinigamiCMS\System\Core\Objectbase {
    
    public function Index() {
        if ($this->loader->load_library('blog_layout')) {
            return $this->blog_layout->render_front_page();
        }
        else {
            return "Error Loading Library?!";
        }
    }
    
    public function Create_user($username, $password) {
        if ( (! $username) || (! $password) ) {
            return 'Username AND Password Required! Not Supplied!';
        }
        
        if ( $this->loader->load_model('blog_user') ) {
            
            $user_obj = new Blog_user();
            $res = $user_obj->create_user($username, $password);
            if ($res['Error_code']) {
                return 'User Created Successfully';
            }
            else {
                return 'User Creation Failed!: ' . $res['Error_info'][2];
            }
            
        }
        
    }
    
    public function Test_login($username, $password) {
        if ( (!$username) || (!$password) ) { 
            return 'Username AND Password Required! Not Supplied.';
        }
        
        if ($this->loader->load_model('blog_user')) {
            $user_obj = new Blog_user();
            if ($user_obj->validate_login($username, $password)) {
                return 'User Logged In Successfully<br />Welcome ' . $user_obj->get_username() . ' :: ' . $user_obj->get_userid();
            }
            else {
                return 'Login Failed.';
            }
        }
        else {
            return 'Problem loading blog_user model';
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
    
    public function Test_userid($id) {
        if ( (! $id ) || (!is_numeric($id)) ) {
            return 'Invalid User ID Provided';
        }
        
        $this->loader->load_model('blog_user');
        $user_obj = new Blog_user();
        if ( $user_obj->fetch_user_by_id($id)) {
            return 'That userid belongs to ' . $user_obj->get_username();
        }
        else {
            return 'User Not Found';
        }
    }
    
    public function Test_username($username) {
        if ( !$username ) {
            return 'Invalid Username Provided';
        }
        
        $this->loader->load_model('blog_user');
        $user_obj = new Blog_user();
        if ( $user_obj->fetch_user_by_name($username)) {
            return 'That username belongs to ' . $user_obj->get_username() . ' who has a userid of ' . $user_obj->get_userid();
        }
        else {
            return 'User Not Found';
        }
    }
}

?>
