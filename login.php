<?php

include("connection.php");

// variables
$username = $_POST["username"];
$password = $_POST["password"];
$response = [];

// checking username if exist
$check_username_sql = "SELECT username FROM users WHERE username =? ";
$select = $mysqli->prepare($check_username_sql);
$select->bind_param("s", $username);
$select->execute();
$username_check = $select->get_result();

if(mysqli_num_rows($username_check)) {
    $response["status"] = "user not found";
    exit($json = json_encode($response));
}

?>