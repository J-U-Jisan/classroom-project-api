<?php
class Teacher{
	private $conn;
	private $table_name = "teachers";

	public $userid;
	public $pass;
	public $admin_id;
	public $email;
	public $name;
	public $institute;
	public $contact_no;
	public $address;

	public function __construct($db){
        $this->conn = $db;
    }

    function read(){
    	$query = "SELECT 
    				p.userid, p.pass, p.admin_id, p.institute, p.email, p.name, p.contact_no, p.address
    			FROM " . $this->table_name . " p";

    	$stmt = $this->conn->prepare($query); 
    	
    	$stmt->execute();

    	return $stmt;

    }

     function create(){
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    userid=:userid, pass=:pass, admin_id=:admin_id, institute=:institute, email=:email, name=:name, contact_no=:contact_no, address=:address;";

        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->userid=htmlspecialchars(strip_tags($this->userid));
        $this->pass=htmlspecialchars(strip_tags($this->pass));
        $this->admin_id=htmlspecialchars(strip_tags($this->admin_id));
        $this->institute=htmlspecialchars(strip_tags($this->institute));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->contact_no=htmlspecialchars(strip_tags($this->contact_no));
        $this->address=htmlspecialchars(strip_tags($this->address));
     
        // bind values
        $stmt->bindParam(":userid", $this->userid);
        $stmt->bindParam(":pass", $this->pass);
        $stmt->bindParam(":admin_id", $this->admin_id);
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
    function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE userid =:userid && admin_id =:admin_id;";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->userid=htmlspecialchars(strip_tags($this->userid));
    $this->admin_id=htmlspecialchars(strip_tags($this->admin_id));
 
    // bind id of record to delete
    $stmt->bindParam(":userid", $this->userid);
    $stmt->bindParam(":admin_id", $this->admin_id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
    }
}
?>