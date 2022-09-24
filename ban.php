<?php 
include("connection.php");
$id=$_POST['id'];
$banned=$_POST['banned'];
// Insert the id of admin and the seller's id that he got banned into a row of ban table
$ban_seller=$mysqli->prepare("INSERT INTO ban(admin_id,client_id) VALUES (?,?)");
$ban_seller->bind_param("ss",$id,$banned);
$response=[];
// If the above query has been executed, we have to return status as done, otherwise, we have to return error.
if($ban_seller->execute()){
    $response['status']="done";
}else{
    $response['status']="error";
}
echo json_encode($response);
?>