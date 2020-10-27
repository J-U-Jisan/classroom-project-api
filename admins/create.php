<?php

    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("X-HTTP-Method-Override: PATCH");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header("Authorization: cce326abfc384ef5a674f11e5587ede1");
    // get database connection
    include_once '../config/database.php';
     
    // instantiate product object
    include_once '../objects/admin.php';


    $database = new Database();
    $db = $database->getConnection();
     
    $admin = new Admin($db);
    // set product property values
    $admin->userid = $_POST['userid'];
    $admin->pass = $_POST['password'];
    //$con_pass = $_POST['confirm'];
    $admin->email = $_POST['email'];
    $admin->institute = $_POST['institute'];
    $admin->name = $_POST['name'];
    $admin->contact_no = $_POST['contact_no'];
    $admin->address= $_POST['address'];
 
    // create the product
    if($admin->create()){
 
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