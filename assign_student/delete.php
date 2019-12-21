<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../config/database.php';
include_once '../objects/assign_student.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$assign_student = new Assign_student($db);
  
// set product id to be deleted
$assign_student->courseno = $_POST['courseno'];
$assign_student->admin_id = $_POST['admin_id']; 
$assign_student->studentid = $_POST['studentid'];
// delete the product
if($assign_student->delete()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Successful"));
}
// if unable to delete the product
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "failed"));
}
?>