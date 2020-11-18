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
    include_once '../objects/routine.php';


    $database = new Database();
    $db = $database->getConnection();
     
    $routine = new Routine($db);
    
    $routine->courseno = $_POST['courseno'];
    $routine->teacherid = $_POST['teacherid'];
    $routine->admin_id = $_POST['admin_id'];
    $routine->day = $_POST['day'];
    $routine->start_time = $_POST['start_time'];
    $routine->end_time = $_POST['end_time'];
    
    // create the product
    if($routine->create()){
 
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