<?php


class Database{
 
    // specify your own database credentials
    private $host;
    private $db_name;
    private $username ;
    private $password;
    public $conn;
    
    public function __construct($dbArgs) {
        
        $this->host = $dbArgs["host"];
        $this->db_name = $dbArgs["database_name"];
        $this->username = $dbArgs["username"];
        $this->password = $dbArgs["password"];
    }
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
    
    public function close() {
        $this->conn = null;
    }
    public function __destruct() {
        $this->close();
    }
}
