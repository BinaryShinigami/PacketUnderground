<?php

use PacketUnderground\Models\Blog_user;
use PacketUnderground\Models\Blog_post;

class Admin extends \ShinigamiCMS\System\Core\Objectbase {
    
    public function Index() {
        
        $this->loader->load_model('blog_user');
        
        $uid = $_SESSION['uid'];
        if (!$uid) {
            return $this->show_login();
        }
        else {
            
            $user = new Blog_user();
            $user->fetch_user_by_id($uid);
            if (! $this->is_admin($user)) {
                return $this->blog_layout->render_page('<h2 align="center">Sorry but you\'re not an admin!</h2>');
            }
            
            $page = '<h2 align="center">Welcome ' . $user->get_username() . '</h2>
                Please Select an action to perform: <br />
                <a href="/admin/add_post/">Add New Blog Post</a><br />';
            return $this->blog_layout->render_page($page);
        }
        
    }
    
    public function add_post() {
        $this->loader->load_model('blog_user');
        $this->loader->load_model('blog_post');
        
        $user = $this->get_user();
        
        if (!$user) {
            header('location: /admin/login');
        }
        if (! $this->is_admin($user)) {
            return $this->render_admin_msg();
        }
        
        if ( (!isset($_POST['title'])) || (!isset($_POST['content'])) || (!isset($_POST['slug']))) {
            return $this->blog_layout->render_blog_post_form();
        }
        else {
            $post = new Blog_post();
            $post->set_authorid($user->get_userid());
            $post->set_contents($_POST['content']);
            $post->set_slug($_POST['slug']);
            $post->set_title($_POST['title']);
            $data = $post->commit_post();
            if ($data) {
                return $this->blog_layout->render_page('<h2 align="center">Post Added!</h2><a href="/">Click Here</a>');
            }
            else {
                return $this->blog_layout->render_page('<h2 align="center">Post Creation Failed!</h2>Reason: ' . $data);
            }
        }
    }
    
    public function Login() {
        if ( (!isset($_POST['uname'])) || (!isset($_POST['pword'])) ) {
            return $this->show_login();
        }
        else {
            $this->loader->load_model('blog_user');
            $user = new Blog_user();
            
            $username = $_POST['uname'];
            $password = $_POST['pword'];
            
            if (!$user->validate_login($username, $password)) {
                return $this->blog_layout->render_page('<h2 align="center">Invalid Login</h2>');
            }
            
            $_SESSION['uid'] = $user->get_userid();
            return $this->blog_layout->render_page('<h2>Welcome</h2><script>document.location="/admin/";</script>');
        }
    }
    
    public function Change_password() {
        $this->loader->load_model('blog_user');
        if ( (!isset($_POST['uname'])) || (!isset($_POST['pword'])) ) {
            $form = '<h2 align="center">Change Password</h2>
                <form action="/admin/change_password/" method="post">
                Username: <input type="text" name="uname" id="uname" /><br />
                New Password: <input type="password" name="pword" id="pword" /><br />
                <input type="submit" value="Change Password" />
                </form>';
            return $this->blog_layout->render_page($form);
        }
        else {
            $user = new Blog_user();
            if ($user->fetch_user_by_name($_POST['uname'])) {
                $password = $user->generate_password_hash($_POST['pword'], $user->get_salt());
                return $this->blog_layout->render_page($password);
            }
        }
    }
    
    private function is_admin(Blog_user $user) {
        
        if ($user->get_permissions() & Blog_user::$ADMIN_BIT ) {
            return TRUE;
        }
        
        return FALSE;
        
    }
    
    private function render_admin_msg() {
        return $this->blog_layout->render_page('<h2 align="center">This page requires Administrator Privelages</h2>');
    }
    
    /**
     * Pulls the user id from the PHP session cookie and fetches the user info.
     * Returns FALSE if no uid set or bad UID, otherwise returns the user info in a Blog_user obj.
     * 
     * @return boolean|\PacketUnderground\Models\Blog_user
     */
    private function get_user() {
        $uid = $_SESSION['uid'];
        if (!$uid) {
            return FALSE;
        }
        
        $user = new Blog_user();
        if ($user->fetch_user_by_id($uid)) {
            return $user;
        }
        return FALSE;
    }
    
    private function show_login() {
        $output =  '<h2 algin="center">Please Login</h2>
                <form action="/admin/login" method="post">
                    Username: <input type="text" name="uname" id="uname" /><br />
                    Password: <input type="password" name="pword" id="pword" /><br />
                    <input type="submit" value="Login" />
                </form>
                ';
            
            return $this->blog_layout->render_page($output);
    }
    
}


/* End of admin.php */
