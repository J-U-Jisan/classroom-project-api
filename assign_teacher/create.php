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
    include_once '../objects/assign_teacher.php';


    $database = new Database();
    $db = $database->getConnection();
     
    $assign_teacher = new Assign_teacher($db);
    // set product property values
    $assign_teacher->courseno = $_POST['courseno'];
    $assign_teacher->teacherid = $_POST['teacherid'];
    $assign_teacher->admin_id = $_POST['admin_id'];
    
 
    // create the product
    if($assign_teacher->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode("Registration Successful");
    }
 
    // if unable to create the product, tell the user
    else{
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create account."));
    }

?>