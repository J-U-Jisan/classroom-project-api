<?php

    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
     
    // get database connection
    include_once '../config/database.php';
     
    // instantiate product object
    include_once '../objects/attendance.php';


    $database = new Database();
    $db = $database->getConnection();
     
    $attendance = new Attendance($db);
    // set product property values
    $attendance->day = $_POST['day'];
    $attendance->studentid = $_POST['studentid'];
    $attendance->courseno = $_POST['courseno'];
    $attendance->teacherid = $_POST['teacherid'];
    $attendance->present = $_POST['present'];
    $attendance->admin_id = $_POST['admin_id'];
    
 
    // create the product
    if($attendance->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode("Successful");
    }
 
    // if unable to create the product, tell the user
    else{
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode("Failed");
    }

?>