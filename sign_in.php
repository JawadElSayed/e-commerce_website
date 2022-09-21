<?php

include("connection.php");

// variables
$_name = $_POST["name"];
$_email = $_POST["email"];
$_username = $_POST["username"];
$_password = $_POST["password"];

// checking email if exist
$_check_email_sql = "SELECT email FROM users WHERE email = ?";
$select = $mysqli->prepare($_check_email_sql);
$select->bind_param("s", $_email);
$select->execute();
$email_check = $select->get_result();

if(mysqli_num_rows($email_check)) {
    $response["status"] = "used email";
    exit($json = json_encode($response));
}


?>