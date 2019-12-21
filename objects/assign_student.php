<?php
class Assign_student{
    private $conn;
    private $table_name = "assign_student";

    public $courseno;
    public $studentid;
    public $admin_id;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT 
                    p.courseno, p.studentid, p.admin_id
                FROM " . $this->table_name . " p ORDER BY p.studentid;";

        $stmt = $this->conn->prepare($query); 
        
        $stmt->execute();

        return $stmt;
    }

     function create(){
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " 
                SET
                    courseno=:courseno, studentid=:studentid, admin_id=:admin_id;";

        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->courseno=htmlspecialchars(strip_tags($this->courseno));
        $this->studentid=htmlspecialchars(strip_tags($this->studentid));
        $this->admin_id=htmlspecialchars(strip_tags($this->admin_id));
     
        // bind values
        $stmt->bindParam(":courseno", $this->courseno);
        $stmt->bindParam(":studentid", $this->studentid);
        $stmt->bindParam(":admin_id", $this->admin_id);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
         
    }
    function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE courseno =:courseno && admin_id =:admin_id && studentid =:studentid;";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->courseno=htmlspecialchars(strip_tags($this->courseno));
    $this->admin_id=htmlspecialchars(strip_tags($this->admin_id));
    $this->studentid = htmlspecialchars(strip_tags($this->studentid));

    // bind id of record to delete
    $stmt->bindParam(":courseno", $this->courseno);
    $stmt->bindParam(":admin_id", $this->admin_id);
    $stmt->bindParam(":studentid", $this->studentid);
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
    }
}
?>