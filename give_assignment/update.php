<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/give_assignment.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$give_assignment = new Give_assignment($db);
  
// get id of product to be edited
 
// set ID property of product to be edited
$give_assignment->id = $_POST['id'];
$give_assignment->check = $_POST['check'];
 
// update the product
if($give_assignment->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Updated."));
}
 
// if unable to update the product, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update."));
}
?>