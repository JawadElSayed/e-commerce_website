<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
// Get all parameters using POST method
if(isset($_POST['discount_percentage'])){
    $discount_percentage=$_POST['discount_percentage'];
    $end_at=$_POST['end_at'];
    $seller_id=$_POST['seller_id'];
    $product_id =$_POST['product_id'];
    //Get the current time 
    date_default_timezone_set('Asia/Beirut');
    $current_time = date ("Y-m-d");
    // Create random code from 5 characters
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $discount_code = substr( str_shuffle( $chars ), 0, 5 );
    // Insert the parameters into discount_codes table
    $add_discount=$mysqli->prepare("INSERT INTO `discount_codes`(`discount_code`, `discount_percentage`, `created_at`, `end_at`, `seller_id`, `product_id`) VALUES ( ?, ?, ?, ?, ?,?);");
    $add_discount->bind_param("ssssss",$discount_code,$discount_percentage,$current_time,$end_at,$seller_id,$product_id);
    $response=[];
    // If the above query has been executed, the response should be done, otherwise, it should be error.
    if($add_discount->execute()){
        $response['status']="done";
    }else{
        $response['status']="error";
    }
    echo json_encode($response);
}
?>