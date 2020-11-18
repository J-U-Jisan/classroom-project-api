<?php
class Routine{
	private $conn;
	private $table_name = "routine";

    public $teacherid;
	public $courseno;
	public $admin_id;
    public $day;
	public $start_time;
    public $end_time;

	public function __construct($db){
        $this->conn = $db;
    }

    function read(){
    	$query = "SELECT 
    				p.id, p.admin_id, p.teacherid, p.courseno, p.day, p.start_time, p.end_time
    			FROM " . $this->table_name . " p ORDER BY id;";

    	$stmt = $this->conn->prepare($query); 
    	
    	$stmt->execute();

    	return $stmt;
    }

     function create(){
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " 
                SET
                    teacherid=:teacherid, courseno=:courseno, admin_id=:admin_id, day=:day, start_time=:start_time, end_time=:end_time;";

        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->teacherid=htmlspecialchars(strip_tags($this->teacherid));
        $this->courseno=htmlspecialchars(strip_tags($this->courseno));
        $this->admin_id=htmlspecialchars(strip_tags($this->admin_id));
        $this->day=htmlspecialchars(strip_tags($this->day));
        $this->start_time=htmlspecialchars(strip_tags($this->start_time));
        $this->end_time = htmlspecialchars(strip_tags($this->end_time));
     
        // bind values
        $stmt->bindParam(":teacherid", $this->teacherid);
        $stmt->bindParam(":courseno", $this->courseno);
        $stmt->bindParam(":admin_id", $this->admin_id);
        $stmt->bindParam(":day", $this->day);
        $stmt->bindParam(":start_time", $this->start_time);
        $stmt->bindParam(":end_time", $this->end_time);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
         
    }
    function update(){
     
        // update query
        $query = "UPDATE " . $this->table_name . " SET
                    day = :day, start_time = :start_time, end_time = :end_time
                    
                WHERE
                    id = :id";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->day=htmlspecialchars(strip_tags($this->day));
     	$this->start_time=htmlspecialchars(strip_tags($this->start_time));
     	$this->end_time=htmlspecialchars(strip_tags($this->end_time));
        // bind new values
       
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":day", $this->day);
     	$stmt->bindParam(":start_time", $this->start_time);
     	$stmt->bindParam(":end_time", $this->end_time);
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }

    function delete()
    {
    	$query = "DELETE FROM " . $this->table_name . " WHERE id =:id";
    	
    	$stmt = $this->conn->prepare($query);

    	$this->id=htmlspecialchars(strip_tags($this->id));

    	$stmt->bindParam(":id", $this->id);
    	
    	// execute query
	    if($stmt->execute()){
	        return true;
	    }
	 
	    return false;
    }
}
?>