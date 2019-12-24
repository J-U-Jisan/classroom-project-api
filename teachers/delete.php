<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../config/database.php';
include_once '../objects/teacher.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$teacher = new Teacher($db);
  
// set product id to be deleted
$teacher->userid = $_POST['userid'];
$teacher->admin_id = $_POST['admin_id']; 
// delete the product
if($teacher->delete()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode("Account Deleted Successfully");
}
 
// if unable to delete the product
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode("Account Deletion Failed");
}
?>