<?php
class Attendance{
	private $conn;
	private $table_name = "attendance";

    public $day;
    public $studentid;
	public $courseno;
    public $teacherid;
    public $present;
	public $admin_id;

	public function __construct($db){
        $this->conn = $db;
    }

    function read(){
    	$query = "SELECT 
    				p.day, p.studentid, p.courseno, p.teacherid, p.present, p.admin_id
    			FROM " . $this->table_name . " p";

    	$stmt = $this->conn->prepare($query); 
    	
    	$stmt->execute();

    	return $stmt;
    }

     function create(){
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " 
                SET
                    day=:day, studentid=:studentid, courseno=:courseno, teacherid=:teacherid, present=:present, admin_id=:admin_id;";

        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->day=htmlspecialchars(strip_tags($this->day));
        $this->studentid=htmlspecialchars(strip_tags($this->studentid));
        $this->courseno=htmlspecialchars(strip_tags($this->courseno));
        $this->teacherid=htmlspecialchars(strip_tags($this->teacherid));
        $this->present=htmlspecialchars(strip_tags($this->present));
        $this->admin_id=htmlspecialchars(strip_tags($this->admin_id));
     
        // bind values
        $stmt->bindParam(":day", $this->day);
        $stmt->bindParam(":studentid", $this->studentid);
        $stmt->bindParam(":courseno", $this->courseno);
        $stmt->bindParam(":teacherid", $this->teacherid);
        $stmt->bindParam(":present", $this->present);
        $stmt->bindParam(":admin_id", $this->admin_id);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
         
    }
    function update(){
     
        // update query
        $query = "UPDATE " . $this->table_name . " SET
                    present = :present
                    
                WHERE
                    day = :day && studentid = :studentid && courseno = :courseno";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->present=htmlspecialchars(strip_tags($this->present));
        $this->day=htmlspecialchars(strip_tags($this->day));
        $this->studentid=htmlspecialchars(strip_tags($this->studentid));
        $this->courseno=htmlspecialchars(strip_tags($this->courseno));
     
        // bind new values
        $stmt->bindParam(":present", $this->present);
        $stmt->bindParam(":day", $this->day);
        $stmt->bindParam(":studentid", $this->studentid);
        $stmt->bindParam(":courseno", $this->courseno);
     
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }
}
?>