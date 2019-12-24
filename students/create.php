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
    include_once '../objects/student.php';


    $database = new Database();
    $db = $database->getConnection();
     
    $student = new Student($db);
    // set product property values
    $student->userid = $_POST['userid'];
    $student->pass = $_POST['password'];
    $student->admin_id = $_POST['admin_id'];
    $student->email = $_POST['email'];
    $student->institute = $_POST['institute'];
    $student->name = $_POST['name'];
    $student->contact_no = $_POST['contact_no'];
    $student->address= $_POST['address'];
 
    // create the product
    if($student->create()){
 
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