<?php
class Mark{
	private $conn;
	private $table_name = "marks";

    public $teacherid;
    public $studentid;
	public $courseno;
    public $topic;
	public $mark;
    public $outof;

	public function __construct($db){
        $this->conn = $db;
    }

    function read(){
    	$query = "SELECT 
    				p.id, p.teacherid, p.studentid, p.courseno, p.topic, p.mark, p.outof
    			FROM " . $this->table_name . " p ORDER BY studentid;";

    	$stmt = $this->conn->prepare($query); 
    	
    	$stmt->execute();

    	return $stmt;
    }

     function create(){
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " 
                SET
                    teacherid=:teacherid, studentid=:studentid, courseno=:courseno, topic=:topic, mark=:mark, outof=:outof;";

        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->teacherid=htmlspecialchars(strip_tags($this->teacherid));
        $this->studentid=htmlspecialchars(strip_tags($this->studentid));
        $this->courseno=htmlspecialchars(strip_tags($this->courseno));
        $this->topic=htmlspecialchars(strip_tags($this->topic));
        $this->mark=htmlspecialchars(strip_tags($this->mark));
        $this->outof = htmlspecialchars(strip_tags($this->outof));
     
        // bind values
        $stmt->bindParam(":teacherid", $this->teacherid);
        $stmt->bindParam(":studentid", $this->studentid);
        $stmt->bindParam(":courseno", $this->courseno);
        $stmt->bindParam(":topic", $this->topic);
        $stmt->bindParam(":mark", $this->mark);
        $stmt->bindParam(":outof", $this->outof);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
         
    }
    function update(){
     
        // update query
        $query = "UPDATE " . $this->table_name . " SET
                    mark = :mark
                    
                WHERE
                    id = :id";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->mark=htmlspecialchars(strip_tags($this->mark));
     
        // bind new values
       
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":mark", $this->mark);
     
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }
}
?>