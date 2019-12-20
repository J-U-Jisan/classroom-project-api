<?php
	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	$host = "localhost";
	$username="root";
	$pwd="";
	$db="api";
	$conn = mysqli_connect($host,$username,$pwd,$db);

	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 

	$query = "SELECT studentid, teacherid, courseno, name, file, drive FROM assignment;";
	$stmt = $conn->query($query);
     
    
    $num = $stmt->num_rows;
    if($num>0){
 
	    // products array
	    $file_arr=array();
	    $file_arr["records"]=array();
	 
	    // retrieve our table contents
	    // fetch() is faster than fetchAll()
	    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	    while ($row = $stmt->fetch_assoc()){
	        // extract row
	        // this will make $row['name'] to
	        // just $name only
	        extract($row);
	 
	        $file_list=array(
	            "studentid" => $studentid,
	            "teacherid" => $teacherid,
	            "courseno" => $courseno,
	            "name" => $name,
	            "file" => $file,
	            "drive" => $drive
	        );
	 
	        array_push($file_arr["records"], $file_list);
	    }
	 
	    // set response code - 200 OK
	    http_response_code(200);
	 
	    // show products data in json format
	    echo json_encode($file_arr);
	}
	 
	else{
	 
	    // set response code - 404 Not found
	    http_response_code(404);
	 
	    // tell the user no products found
	    echo json_encode(
	        array("message" => "No products found.")
	    );
	}
?>
