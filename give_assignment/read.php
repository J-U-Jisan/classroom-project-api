<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/give_assignment.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$give_assignment = new Give_assignment($db);
 
// query products
$stmt = $give_assignment->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $give_assignment_arr=array();
    $give_assignment_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $give_assignment_list=array(
            "id" => $id,
            "teacherid" => $teacherid,
            "studentid" => $studentid,
            "courseno" => $courseno,
            "topic" => $topic,
            "given" => $given,
            "deadline" => $deadline
        );
 
        array_push($give_assignment_arr["records"], $give_assignment_list);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($give_assignment_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
    array("message" => "No products found.")
    );
}