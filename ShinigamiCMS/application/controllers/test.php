<?php

use PacketUnderground\Models\Blog_user;
use PacketUnderground\Models\Blog_post;
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
    
    public function Create_post() {
        if ((!isset($_POST['title'])) || (!isset($_POST['slug'])) || (!isset($_POST['authorid']))) {
            $content = '<div class="center"><h1>Create Post</h1><form action="" method="post">
                Title: <input type="text" id="title" name="title" /><br />
                Slug: <input type="text" id="slug" name="slug" /><br />
                Author ID: <input type="text" id="authorid" name="authorid" value="0" /><br />
                Content:<br /><textarea cols=30 rows=15 name="content" id="content"></textarea><br />
                <input type="submit" />
                </form></div>';
            $this->loader->load_library('blog_layout');
            return $this->blog_layout->render_page($content);
        }
        else {
            if (!$this->loader->load_model('blog_post')) {
                die('Unable to load blog post model?!');
            }
            $post = new Blog_post();
            $post->set_title($_POST['title']);
            $post->set_authorid($_POST['authorid']);
            $post->set_slug($_POST['slug']);
            $post->set_contents($_POST['content']);
            $error = $post->commit_post();
            if (! $error) {
                $msg = 'Post Created Successfully!';
            }
            else {
                $msg = 'Post Creation Failed!  : ' . $error[2];
            }
            $this->loader->load_library('blog_layout');
            return $this->blog_layout->render_page($msg);
        }
        
        
    }
    
    public function View_post_id($id) {
        $this->loader->load_library('blog_layout');
        $this->loader->load_model('blog_post');
        
        $post = new Blog_post();
        if ($post->fetch_post_by_id($id)) {
            $data = 'Post Title: ' . $post->get_title() . '<br />
                    Post Author: ' . $post->get_author() . '<br />
                    Post Timestamp: ' . $post->get_timestamp() . '<br />
                    Post Slug: ' . $post->get_slug() . '<br />
                    Post Content: ' . $post->get_contents();
            return $data;
        }
        return 'That post Doesnt exit';
        
    }
    
    public function View_post_slug($slug) {
        $this->loader->load_library('blog_layout');
        $this->loader->load_model('blog_post');
        
        $post = new Blog_post();
        if ($post->fetch_post_by_slug($slug)) {
            $data = 'Post Title: ' . $post->get_title() . '<br />
                    Post ID: ' . $post->get_id() . '<br />
                    Post Author: ' . $post->get_author() . '<br />
                    Post Timestamp: ' . $post->get_timestamp() . '<br />
                    Post Slug: ' . $post->get_slug() . '<br />
                    Post Content: ' . $post->get_contents();
            return $data;
        }
        return 'That post Doesnt exit';
    }
}

?>
