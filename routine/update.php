<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/routine.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$routine = new Routine($db);
 
// get id of product to be edited
 
// set ID property of product to be edited
$routine->day = $_POST['day'];
$routine->start_time = $_POST['start_time'];
$routine->end_time = $_POST['end_time'];
$routine->id = $_POST['id'];
 
 
// update the product
if($routine->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode("Updated.");
}
 
// if unable to update the product, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode("Unable to update.");
}
?>