<?php
require_once("dbConnect.php");

class user{
    private $db;
    public function __construct(){
        $this->db = DBConnector::connect();
    }
    
    ////////////////////////
    ///////Sign up//////////
    ////////////////////////
    
    public function signUpUser($username,$password,$email,$displayname){
        
        $sql = "SELECT * FROM user WHERE username = :username or email = :email";
        
        $rowCount = count($this->db->read($sql,array(
            ':username' => $username,
            ':email' =>$email
        )));
        
        
       if($rowCount == 0){
        
        $sql = "INSERT INTO user (username, password, email, displayname, picture, type) VALUES (:username, :password, :email, :displayname, :picture, :type)";
        $result = $this->db->CUD($sql,array(
            ':username' => $username,
            ':password' => md5($password),
            ':email'=> $email,
            ':displayname' => $displayname,
            ':picture' => 'http://localhost:8888/lushApp/lushAppServer/ProfilePic/CoreSyncInstall.png',
            ':type' => 'user'
        ));
        if($result === true){
            echo json_encode(array("status"=>"success","user"=>$displayname));
        }
       }else{
           echo json_encode(array("status"=>"fail","reason"=>"email or username has been taken."));
       }
        
    
    }
    
    ////////////////////////
    ////end of Sign up//////
    ////////////////////////
    
    
    
    //////Login///////
    
    public function logInUser($username,$password){
        $sql = "SELECT username, email, displayname, picture, type FROM user WHERE username = :username AND password = :password";
        $result = $this->db->read($sql,array(
            ':username' => $username,
            ':password' => md5($password)
        ));

        if($result){
        echo json_encode($result);
        }elseif(!$result){
        echo json_encode("Invalid Username or Password"); 
        }
    }
    
    /////end of login//////
    
    
    
    
    
    public function updateUser($column, $value, $username){
        $sql = "UPDATE user SET $column = :value WHERE username = :username";
        
        $this->db->CUD($sql,array(
            ':value' => $value,
            ':username' => $username
        ));
        
    }
}

?>