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
    include_once '../objects/teacher.php';


    $database = new Database();
    $db = $database->getConnection();
     
    $teacher = new Teacher($db);
    // set product property values
    $teacher->userid = $_POST['userid'];
    $teacher->pass = $_POST['password'];
    $teacher->admin_id = $_POST['admin_id'];
    $teacher->email = $_POST['email'];
    $teacher->institute = $_POST['institute'];
    $teacher->name = $_POST['name'];
    $teacher->contact_no = $_POST['contact_no'];
    $teacher->address= $_POST['address'];
 
    // create the product
    if($teacher->create()){
 
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
        echo json_encode("Registration Failed");
    }

?>