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
    include_once '../objects/mark.php';


    $database = new Database();
    $db = $database->getConnection();
     
    $marks = new Mark($db);
    // set product property values
    $marks->studentid = $_POST['studentid'];
    $marks->courseno = $_POST['courseno'];
    $marks->teacherid = $_POST['teacherid'];
    $marks->topic = $_POST['topic'];
    $marks->mark = $_POST['mark'];
    
 
    // create the product
    if($marks->create()){
 
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