<?php
class DBConnector {
    private $dbname = null, $dbhost = null, $username = null, $password = null, $con = null;
    
    private static $instance = null;
    
    private function __construct($connectInfo = array()) {
        $this->dbname = $connectInfo['dbName'];
        $this->dbhost = $connectInfo['dbHost'];
        $this->username = $connectInfo['userName'];
        $this->password = $connectInfo['passWord'];
        
        try{
        
            $this->con = new PDO("mysql:host=".$this->dbhost.";dbname=".$this->dbname, $this->username, $this->password);
        
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //echo "success";
            
        }catch(PDOException $e){
            
            echo json_encode("Connection Failed: "/* . $errorMessage->getMessage()*/);
        }
    }
    
    public static function connect($connectInfo = null){
        if($connectInfo == null){
            
            $connectInfo = array(
                'dbName'=>'lush_IM',
                'dbHost' => 'localhost',
                'userName' => 'root',
                'passWord' => 'root'
            );
        }
       
        if(self::$instance == null) {
            self::$instance = new DBConnector($connectInfo);
        }
       
        return self::$instance;
    }
    
    public function getTransaction($sql) {
        try {
            if($this->con != null){
                $this->con->beginTransaction();
                $this->con->exec($sql);
                $lastID = $this->con->lastInsertId();
                $this->con->commit();
                return $lastID;
            } else {
                echo json_encode("error:" . "PDO CONNECTION IS NULL");
                $this->con->rollBack();
                return -1;
            }
            return -1;
        }catch(PDOException $e){
            
            echo json_encode("Connection Failed: "/* . $errorMessage->getMessage()*/);
        }
    }
    
    public function affectRows($sql) {
        try{
            if($this->con != null){
                $affectedRow = $this->con->exec($sql);
                return $affectedRow;
            }else{
                echo json_encode("error:" . "PDO CONNECTION IS NULL");
                return 0;
            }
            return 0;
        }catch(PDOException $e){
            
            echo json_encode("Connection Failed: "/* . $errorMessage->getMessage()*/ . $e->getMessage());
        }
    }
    
    public function read($sql, $array = array()){
        try {
            if($this->con != null){
                $stmt = $this->con->prepare($sql);
                $stmt->execute($array);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
               
                return $result;
               
            } else {
                echo json_encode("error:" . "PDO CONNECTION IS NULL");
            }
            
            return array();
        }catch(PDOException $e){
            
            echo json_encode("Connection Failed: " . $e->getMessage() /* . $errorMessage->getMessage()*/);
        }
        
    }
    
    public function CUD($sql, $array = array()){
        try {
            if($this->con != null){
                $stmt = $this->con->prepare($sql);
                $affectedRow = $stmt->execute($array);
                return $affectedRow;
               
            } else {
                echo json_encode("error:" . "PDO CONNECTION IS NULL");
                return 0;
            }
            
            return 0;
        }catch(PDOException $e){

            echo json_encode("Connection Failed: " . $e->getMessage() /* . $errorMessage->getMessage()*/);
        }
        
    }
    
}


?>