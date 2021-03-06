<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../config/database.php';
include_once '../objects/assign_teacher.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$assign_teacher = new Assign_teacher($db);
  
// set product id to be deleted
$assign_teacher->courseno = $_POST['courseno'];
$assign_teacher->admin_id = $_POST['admin_id']; 
$assign_teacher->teacherid = $_POST['teacherid'];
// delete the product
if($assign_teacher->delete()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode("Successful");
}
// if unable to delete the product
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode("Failed");
}
?>