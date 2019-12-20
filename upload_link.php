<?php
	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	$host = "localhost";
	$username="root";
	$pwd="";
	$db="api";

	$response = array();
	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(isset($_POST['name']) and isset($_POST['studentid']) and isset($_POST['teacherid']) and isset($_POST['courseno'])){

			$con = mysqli_connect($host,$username,$pwd,$db);

    		if(mysqli_connect_error($con)){
    			echo "Failed To Connect";
    		}

    		$name = $_POST['name'];
    		$studentid = $_POST['studentid'];
    		$teacherid = $_POST['teacherid'];
    		$courseno = $_POST['courseno'];
    		$drive = $_POST['drive'];

    		try{
    			$sql = "INSERT INTO `assignment` (`studentid`,`teacherid`,`courseno`,`name`,`drive`) VALUES(
    			'$studentid','$teacherid','$courseno','$name','$drive');";
    			if(mysqli_query($con,$sql))
    			{
    				$response['error']=false;
    				$response['name']=$name;
    				$response['studentid']=$studentid;
    				$response['teacherid']=$teacherid;
    				$response['courseno']=$courseno;
                    
    			}
    		}
    		catch(Exception $e)
    		{
    			$response['error'] = true;
    			$response['message'] = $e->getMessage();

    		}
    		echo json_encode($response);
    		mysqli_close($con);
		}
	}
?>