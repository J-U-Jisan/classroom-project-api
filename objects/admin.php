<?php
class Admin{
 
    // database connection and table name
    private $conn;
    private $table_name = "admins";
 
    // object properties
    public $userid;
    public $pass;
    public $email;
    public $institute;
    public $name;
    public $contact_no;
    public $address;
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
    function read(){
        
        // select all query
        $query = "SELECT
                    p.userid, p.pass, p.institute, p.email, p.name, p.contact_no, p.address
                FROM " . $this->table_name . " p";     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
        
        return $stmt;
    }
    // create product
    function create(){
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    userid=:userid, pass=:pass, institute=:institute, email=:email, name=:name, contact_no=:contact_no, address=:address;";

        echo $this->userid . ' ' . $this->pass;
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->userid=htmlspecialchars(strip_tags($this->userid));
        $this->pass=htmlspecialchars(strip_tags($this->pass));
        $this->institute=htmlspecialchars(strip_tags($this->institute));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->contact_no=htmlspecialchars(strip_tags($this->contact_no));
        $this->address=htmlspecialchars(strip_tags($this->address));
     
        // bind values
        $stmt->bindParam(":userid", $this->userid);
        $stmt->bindParam(":pass", $this->pass);
        $stmt->bindParam(":institute", $this->institute);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":contact_no", $this->contact_no);
        $stmt->bindParam(":address", $this->address);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
         
    }
}
?>