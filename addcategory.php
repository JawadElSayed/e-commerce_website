<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
// Get all parameters using POST method
if(isset($_POST['category_name'])){
    $category_name=$_POST['category_name'];

    // insert category_name into categories table
    $query=$mysqli->prepare("INSERT INTO categories(category_name) VALUES (?)");
    $query->bind_param("s",$category_name);
    $response=[];
    // if the above query has been executed, the response will be done, otherwise, the response will be error
    if($query->execute()){
        $response['status']="done";
    }else{
        $response['status']="error";
    }
    echo json_encode($response);
    
}