<?php

include("connection.php");

// variables
$name = $_POST["name"];
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$user_type = 1;
$response = [];

// checking email if used
$check_email_sql = "SELECT email FROM users WHERE email =? ";
$select = $mysqli->prepare($check_email_sql);
$select->bind_param("s", $email);
$select->execute();
$email_check = $select->get_result();

if(mysqli_num_rows($email_check)) {
    $response["status"] = "used email";
    exit($json = json_encode($response));
}

// checking username if used
$check_username_sql = "SELECT username FROM users WHERE username =? ";
$select = $mysqli->prepare($check_username_sql);
$select->bind_param("s", $username);
$select->execute();
$username_check = $select->get_result();

if(mysqli_num_rows($username_check)) {
    $response["status"] = "used username";
    exit($json = json_encode($response));
}

?>