<?php
class Assign_teacher{
	private $conn;
	private $table_name = "assign_teacher";

	public $courseno;
	public $teacherid;
	public $admin_id;

	public function __construct($db){
        $this->conn = $db;
    }

    function read(){
    	$query = "SELECT 
    				p.courseno, p.teacherid, p.admin_id
    			FROM " . $this->table_name . " p";

    	$stmt = $this->conn->prepare($query); 
    	
    	$stmt->execute();

    	return $stmt;
    }

     function create(){
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " 
                SET
                    courseno=:courseno, teacherid=:teacherid, admin_id=:admin_id;";

        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->courseno=htmlspecialchars(strip_tags($this->courseno));
        $this->teacherid=htmlspecialchars(strip_tags($this->teacherid));
        $this->admin_id=htmlspecialchars(strip_tags($this->admin_id));
     
        // bind values
        $stmt->bindParam(":courseno", $this->courseno);
        $stmt->bindParam(":teacherid", $this->teacherid);
        $stmt->bindParam(":admin_id", $this->admin_id);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
         
    }
}
?>