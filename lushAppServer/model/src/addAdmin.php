<?php
require_once("dbConnect.php");

class admin{
    private $db;
    
    public function __construct(){
        $this->db = DBConnector::connect();
    }
    
    public function creatAdmin($username,$password,$email,$displayname){
        $sql = "INSERT INTO user (username, password, email, displayname, picture, type) VALUES (:username, :password, :email, :displayname, :picture, :type)";
        $this->db->CUD($sql,array(
            ':username' => $username,
            ':password' => md5($password),
            ':email'=> $email,
            ':displayname' => $displayname,
            ':picture' => 'http://localhost:8888/lushApp/lushAppServer/ProfilePic/CoreSyncInstall.png',
            ':type' => 'admin'
        ));
    }
}

/*$admin = new addAdmin;

$admin->creatAdmin("admin6386","lushAPP001","admin6386@lush.com","Admin001");*/

?>