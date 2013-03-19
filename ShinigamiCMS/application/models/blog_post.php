<?php

/**
 * This file contains the Model code for the blog post objects in the database.
 * 
 * @author Shane McIntosh (BinaryShinigami)
 * @packet PacketUnderground\Models
 */

namespace PacketUnderground\Models;
use ShinigamiCMS\System\Core\Objectbase;
use PacketUnderground\Models\Blog_user;
use \PDO as PDO;

class Blog_post extends Objectbase {
   
    private $title;
    private $slug;
    private $author;
    private $authorid;
    private $timestamp;
    private $contents;
    private $id;
    
    /**
     * Constructor....
     */
    public function __construct() {
        parent::__construct();
        
        $this->loader->load_library('config');
        
        if (!$this->database) {
            try {
                $dsn = $this->config->Database['PDO_Driver'] . ':';
                $dsn .= 'dbname=' . $this->config->Database['Database_Name'] .';';
                $dsn .= 'host=' . $this->config->Database['Hostname'];
                $username = $this->config->Database['Username'];
                $password = $this->config->Database['Password'];
                $persist = $this->config->Database['PDO_PERSIST'];
                $this->database = new PDO($dsn, $username, $password, array(
                    PDO::ATTR_PERSISTENT => $persist
                ));
            }
            catch (Exception $e) {
                return NULL;
            }
        }
        
    }
    
    /**
     * Fetches post data from the database based on the ID provided. Returns False on Fail, True on Success
     * 
     * @param int $id
     * @return boolean
     */
    public function fetch_post_by_id($id) {
        $query_str = 'SELECT * FROM blog_posts WHERE id = :id';
        $stmt = $this->database->prepare($query_str);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$data) {
                return FALSE;
            }
            $this->title = $data['title'];
            $this->authorid = $data['authorid'];
            $this->contents = $data['content'];
            $this->slug = $data['slug'];
            $this->timestamp = $data['timestamp'];
            $this->author = $this->fetch_author_name_by_id($data['authorid']);
            
            return TRUE;
        }
        
        return FALSE;
    }
    
    private function fetch_author_name_by_id($id) {
        $this->loader->load_model('blog_user');
        $author = new Blog_user();
        $author->fetch_user_by_id($id);
        return $author->get_username();
    }
    
    /**
     * Fetches post data from the database based on the post slug provided. Returns False on Fail or True on success.
     * Max supported slug size is 64 characters.
     * 
     * @param string $slug
     * @return boolean
     */
    public function fetch_post_by_slug($slug) {
        $query_str = 'SELECT * FROM blog_posts WHERE slug = :slug';
        $stmt = $this->database->prepare($query_str);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$data) {
                return FALSE;
            }
            $this->title = $data['title'];
            $this->authorid = $data['authorid'];
            $this->contents = $data['content'];
            $this->slug = $slug;
            $this->timestamp = $data['timestamp'];
            $this->id = $data['id'];
            $this->author = $this->fetch_author_name_by_id($data['authorid']);
            
            return TRUE;
            
        }
        
        return FALSE;
    }

    
    /**
     * Commits the post data to the database, creates a new database entry if no ID of post is supplied to be overwritten.
     * Returns True on success or False on fail.
     * 
     * @return boolean
     */
    public function commit_post() {
        $stmt = NULL;
        if ($this->id) {
            $query_str = 'UPDATE blog_posts SET title = :title, authorid = :authorid, content = :content, slug = :slug WHERE id = :id';
            $stmt = $this->database->prepare($query_str);
            $stmt->bindParam(':id', $this->id);
        }
        else {
            $query_str = 'INSERT INTO blog_posts(title, authorid, slug, content, timestamp) VALUES (:title, :authorid, :slug, :content, CURDATE());';
            $stmt = $this->database->prepare($query_str);
        }
        
        $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindParam(':authorid', $this->authorid);
        $stmt->bindParam(':slug', $this->slug, PDO::PARAM_STR);
        $stmt->bindParam(':content', $this->contents, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return TRUE;
        }
        else {
            return $stmt->errorInfo();
        }
    }
    
    //<editor-fold desc="So called get_* functions... accessors whatever you want to call it...">
    public function get_title() {
        return $this->title;
    }
    
    public function get_slug() {
        return $this->slug;
    }
    
    public function get_author() {
        return $this->author;
    }
    
    public function get_authorid() {
        return $this->authorid;
    }
    
    public function get_timestamp() {
        return $this->timestamp;
    }
    
    public function get_contents() {
        return $this->contents;
    }
    
    public function get_id() {
        return $this->id;
    }
    // </editor-fold>
    
    //<editor-fold desc="So called set_* functions">
    
    public function set_title($title) {
        $this->title = $title;
    }
    
    public function set_slug($slug) {
        $this->slug = $slug;
    }
    
    public function set_authorid($authorid) {
        $this->authorid = $authorid;
    }
    
    public function set_timestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    
    public function set_contents($contents) {
        $this->contents = $contents;
    }
    
    
    //</editor-fold>
}

/* End of blog_post.php */
