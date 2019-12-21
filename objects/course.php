<?php
class Course{
	private $conn;
	private $table_name = "courses";

	public $courseno;
	public $coursetitle;
	public $admin_id;

	public function __construct($db){
        $this->conn = $db;
    }

    function read(){
    	$query = "SELECT 
    				p.courseno, p.coursetitle, p.admin_id
    			FROM " . $this->table_name . " p";

    	$stmt = $this->conn->prepare($query); 
    	
    	$stmt->execute();

    	return $stmt;
    }

     function create(){
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " 
                SET
                    courseno=:courseno, coursetitle=:coursetitle, admin_id=:admin_id;";

        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->courseno=htmlspecialchars(strip_tags($this->courseno));
        $this->coursetitle=htmlspecialchars(strip_tags($this->coursetitle));
        $this->admin_id=htmlspecialchars(strip_tags($this->admin_id));
     
        // bind values
        $stmt->bindParam(":courseno", $this->courseno);
        $stmt->bindParam(":coursetitle", $this->coursetitle);
        $stmt->bindParam(":admin_id", $this->admin_id);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
         
    }
    function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE courseno =:courseno && admin_id =:admin_id;";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->courseno=htmlspecialchars(strip_tags($this->courseno));
    $this->admin_id=htmlspecialchars(strip_tags($this->admin_id));
 
    // bind id of record to delete
    $stmt->bindParam(":courseno", $this->courseno);
    $stmt->bindParam(":admin_id", $this->admin_id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
    }
}
?>