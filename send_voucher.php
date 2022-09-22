<?php

include("connection.php");

// inputs
$sender_id = $_POST["sender_id"];
$resever_username = $_POST["resever_username"];
$voucher_amount = $_POSTp["voucher_amount"];
$response = [];

// check username
$sql = "SELECT username FROM users WHERE username = ?";
$select = $mysqli->prepare($sql);
$add->bind_param("s", $usernam);
$add->execute();
$username_check = $select->get_result();

if(!(mysqli_num_rows($username_check))) {
    $response["status"] = "invalid";
    exit(json_encode($response));
}




?>