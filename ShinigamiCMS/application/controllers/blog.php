<?php

/** Root Front End Page of the blog.
 * 
 * @author Shane McIntosh (BinaryShinigami)
 */

use PacketUnderground\Models\Blog_post;
class Blog extends ShinigamiCMS\System\Core\Objectbase {
    
    
     /**
     * Returns the latest 10 blog posts added to the database as blog_post objects in an array.
     * @return \PacketUnderground\Models\Blog_post
     */
    private function fetch_last_ten_posts() {
        $query_str = 'SELECT id FROM blog_posts ORDER BY id DESC LIMIT 10';
        $stmt = $this->database->prepare($query_str);
        $objects = array();
        $obj_num = 0;
        if ($stmt->execute()) {
            $obj_id = $stmt->fetch();
            $obj_id = $obj_id['id'];
            $tpost = new Blog_post();
            $tpost->fetch_post_by_id($obj_id);
            $objects[$obj_num] = $tpost;
            $obj_num++;
        }
        return $objects;
    }
    
     /**
     * The blog's index page, shown when no URL parameters are supplied.
     * Fetches the latest 10 posts from the blog and displays them to the user.
     * 
     * @author Shane McIntosh
     */
    public function Index() {
       
        if (! $this->loader->load_model('blog_post')) {
            return 'Error loading blog_post model';
        }
        
        
       $posts_objects = $this->fetch_last_ten_posts();
       $posts = array();
       foreach($posts_objects as $obj) {
           $post['title'] = $obj->get_title();
           $post['author'] = $obj->get_author();
           $post['timestamp'] = $obj->get_timestamp();
           $post['content'] = $obj->get_contents();
           $post['comment_uri'] = '#';
           $post['comment_count'] = '0';
           array_push($posts, $post);
       }
       return $this->blog_layout->render_front_page($posts);
       //return print_r($posts, true);
        
    }
    
}

/* End of blog.php */
