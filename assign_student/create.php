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
    include_once '../objects/assign_student.php';


    $database = new Database();
    $db = $database->getConnection();
     
    $assign_student = new Assign_student($db);
    // set product property values
    $assign_student->courseno = $_POST['courseno'];
    $assign_student->studentid = $_POST['studentid'];
    $assign_student->admin_id = $_POST['admin_id'];
    
 
    // create the product
    if($assign_student->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode("Admit Student in Course Successful");
    }
 
    // if unable to create the product, tell the user
    else{
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode("Admit Student in Course Failed");
    }

?>