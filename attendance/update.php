<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/attendance.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$attendance = new Attendance($db);
 
// get id of product to be edited
 
// set ID property of product to be edited
$attendance->day = $_POST['day'];
$attendance->studentid = $_POST['studentid'];
$attendance->courseno = $_POST['courseno'];
$attendance->present = $_POST['present'];
 
 
// update the product
if($attendance->update()){
 
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