<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/mark.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$marks = new Mark($db);
 
// get id of product to be edited
 
// set ID property of product to be edited
$marks->id = $_POST['id'];
$marks->mark = $_POST['mark'];
 
// update the product
if($marks->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode( "Updated.");
}
 
// if unable to update the product, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode("Unable to update.");
}
?>