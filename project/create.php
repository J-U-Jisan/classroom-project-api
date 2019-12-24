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
    include_once '../objects/project.php';


    $database = new Database();
    $db = $database->getConnection();
     
    $project = new Project($db);
    // set product property values
    $project->teacherid = $_POST['teacherid'];
    $project->studentid = $_POST['studentid'];
    $project->courseno = $_POST['courseno'];
    $project->topic = $_POST['topic'];
    $project->given = $_POST['given'];
    $project->deadline = $_POST['deadline'];
    
    //$query = "INSERT INTO give_assignment(id,teacherid,studentid,courseno,topic,given)"
    // create the product
    if($project->create()){
 
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