<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
// Get all parameters using POST method
if(isset($_POST['id'])){
    $id=$_POST['id'];
    $stop_discount=$mysqli->prepare("DELETE FROM `discount_codes` WHERE id = ?");
    $stop_discount->bind_param("s",$id);
    $response=[];

    if($stop_discount->execute()){
        $response['status']="done";
    }else{
        $response['status']="error";
    }
    echo json_encode($response);
}