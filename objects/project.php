<?php
class Project{
	private $conn;
	private $table_name = "project";

    public $teacherid;
    public $studentid;
	public $courseno;
    public $topic;
    public $given;
    public $deadline;

	public function __construct($db){
        $this->conn = $db;
    }

    function read(){
    	$query = "SELECT
                	p.id, p.teacherid, p.studentid, p.courseno, p.topic, p.given, p.deadline 
                    FROM " . $this->table_name . " p ORDER BY p.studentid;";

    	$stmt = $this->conn->prepare($query); 
    	
    	$stmt->execute();

    	return $stmt;
    }

    function create(){
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET
                    teacherid=:teacherid, studentid=:studentid, courseno=:courseno, topic=:topic, given=:given, deadline=:deadline ;";

        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize 
        $this->teacherid=htmlspecialchars(strip_tags($this->teacherid));
        $this->studentid=htmlspecialchars(strip_tags($this->studentid));
        $this->courseno=htmlspecialchars(strip_tags($this->courseno));
        $this->topic=htmlspecialchars(strip_tags($this->topic));
        $this->given=htmlspecialchars(strip_tags($this->given));
        $this->deadline=htmlspecialchars(strip_tags($this->deadline));
     
        // bind values
        $stmt->bindParam(":teacherid", $this->teacherid);
        $stmt->bindParam(":studentid", $this->studentid);
        $stmt->bindParam(":courseno", $this->courseno);
        $stmt->bindParam(":topic", $this->topic);
        $stmt->bindParam(":given", $this->given);
        $stmt->bindParam(":deadline", $this->deadline);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
         
    }

    function update(){
     
        // update query
        $query = "UPDATE " . $this->table_name . " SET
                    given = :given
                    
                WHERE
                    id = :id";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->given=htmlspecialchars(strip_tags($this->given));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(":given", $this->given);
        $stmt->bindParam(":id", $this->id);
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }
}
?>