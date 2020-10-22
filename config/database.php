<?php
class Database{
     // specify your own database credentials
    private $host = "ec2-54-246-115-40.eu-west-1.compute.amazonaws.com";
    private $db_name = "d9kedkfr6qjllu";
    private $username = "pgtjvvlriwlswi";
    private $password = "f4dd00d2ba544386ff442844ad6e1c6849f0e7a7450f2e0c660a8d062bd75f04";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
        $dsn = "pgsql:host=$host;port=5432;dbname=$db_name;user=$username;password=$password";
        try{
            $this->conn = new PDO($dsn);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>