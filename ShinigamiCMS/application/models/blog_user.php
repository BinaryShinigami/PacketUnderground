<?php

/**
 * This file contains code for manipulating Users for the PacketUndergroudn CMS.
 * 
 * @author Shane McIntosh (BinaryShinigami)
 * @package PacketUnderground
 */

namespace PacketUnderground\Models;
use ShinigamiCMS\System\Core\Objectbase;
use \PDO as PDO;

class Blog_user extends Objectbase {
    private $id;
    private $username;
    private $passhash;
    private $permissions;
    private $salt;
    
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
     * Generates a random 10 character string for use as a salt in the user database
     * 
     * @return string
     */
    public function generate_salt() {
        $salt = '';
        for ($i = 0; $i <= 10; $i++) {
            $salt .= rand(33, 126);
        }
        
        return $salt;
    }
    
    /**
     * Uses the supplied raw password string and salt string to create a sha256
     * hash for use in authentication.
     * 
     * @param string $password
     * @param string $salt
     * @return string
     */
    public function generate_password_hash($password, $salt) {
        $password = $password . '::' . $salt;
        $password = $salt . md5($password);
        return hash("sha256", $password, FALSE);
    }
    
    /**
     * Fetches user info from a database for the user with the provided ID.
     * 
     * @param int $userid
     * @return boolean
     */
    public function fetch_user_by_id($userid) {
        $query = 'SELECT * FROM blog_users WHERE id = :id';
        $stmt = $this->database->prepare($query);
        if ($stmt->execute(array('id' => $userid))) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($data) {
                $this->id = $data['id'];
                $this->username = $data['username'];
                $this->passhash = $data['password'];
                $this->permissions = $data['permissions'];
                $this->salt = $data['salt'];

                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        else {
            return FALSE;
        }
    }
    
    public function fetch_user_by_name($username) {
        $query = 'SELECT * FROM blog_users WHERE username = :username';
        $stmt = $this->database->prepare($query);
        if ($stmt->execute(array('username' => $username))) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($data) {
                $this->id = $data['id'];
                $this->username = $data['username'];
                $this->passhash = $data['password'];
                $this->permissions = $data['permissions'];
                $this->salt = $data['salt'];

                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        else {
            return FALSE;
        }
    }
    
    /**
     * Checks to see if the credentials supplied are valid. If valid then the user
     * members of the object instance are filled with the proper fields.
     * 
     * @param type $username
     */
    public function validate_login($username, $password) {
        $salt_query = 'SELECT salt FROM blog_users WHERE username = :user';
        $stmt = $this->database->prepare($salt_query);
        if ( $stmt->execute(array('user' => $username))) {
            $this->salt = $stmt->fetch( PDO::FETCH_ASSOC );
            $this->salt = $this->salt['salt'];
            
            $query = 'SELECT * FROM blog_users WHERE username = :user AND password = :passhash';
            $passhash = $this->generate_password_hash($password, $this->salt);
            $stmt = $this->database->prepare($query);
            $stmt->bindParam(':user', $username);
            $stmt->bindParam(':passhash', $passhash);
            if ($stmt->execute()) {
                $data = $stmt->fetch( PDO::FETCH_ASSOC );
                if ($data) {
                    $this->username = $data['username'];
                    $this->passhash = $passhash;
                    $this->permissions = $data['permissions'];
                    $this->id = $data['id'];
                    
                    return TRUE;
                }
                else {
                    return FALSE;
                }
            }
            
        }
        else {
            return FALSE;
        }
    }
    
    /**
     * 
     * @param string $username
     * @param string $password
     * @param int $perms
     * @param string $salt
     * @return boolean
     */
    public function create_user($username, $password, $perms = 0x00, $salt = '') {
        if (!$salt) {
            $salt = $this->generate_salt();
        }
        
        $this->username = $username;
        $this->passhash = $this->generate_password_hash($password, $salt);
        $this->permissions = $perms;
        $this->salt = $salt;
        
        $query = 'INSERT INTO blog_users (username, password, permissions, salt) VALUES (:username, :passhash, :perms, :salt);';
        $stmt = $this->database->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':passhash', $this->passhash);
        $stmt->bindParam(':perms', $this->permissions, PDO::PARAM_INT);
        $stmt->bindParam(':salt', $this->salt);
        
        if ($stmt->execute()) {
            return array('Error_code' => 1);
        }
        else {
            return array(
                'Error_code' => 0,
                'Error_info' => $stmt->errorInfo()
                );
        }
    }
    
    /**
     * Returns username of the user this object represents.
     * @return string
     */
    public function get_username() {
        return $this->username;
    }
    
    /**
     * Returns the userid of the user this object represents.
     * @return string
     */
    public function get_userid() {
        return $this->id;
    }
    
    /**
     * Returns the password hash of the user this object represents.
     * @return string
     */
    public function get_passhash() {
        return $this->passhash;
    }
    
    /**
     * Returns the password salt of the user this object represnts.
     * @return string
     */
    public function get_salt() {
        return $this->salt;
    }
    
    /**
     * Returns the permission INT of the user that this object represents.
     * @return int
     */
    public function get_permissions() {
        return $this->permissions;
    }
    
}

/* End of blog_user.php */
