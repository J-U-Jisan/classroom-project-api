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
    include_once '../objects/give_assignment.php';


    $database = new Database();
    $db = $database->getConnection();
     
    $give_assignment = new Give_assignment($db);
    // set product property values
    $give_assignment->teacherid = $_POST['teacherid'];
    $give_assignment->studentid = $_POST['studentid'];
    $give_assignment->courseno = $_POST['courseno'];
    $give_assignment->topic = $_POST['topic'];
    $give_assignment->given = $_POST['given'];
    $give_assignment->deadline = $_POST['deadline'];
    
    //$query = "INSERT INTO give_assignment(id,teacherid,studentid,courseno,topic,given)"
    // create the product
    if($give_assignment->create()){
 
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