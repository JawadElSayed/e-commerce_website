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

if(!(mysqli_num_rows($username_check))) {
    $response["status"] = "wrong username";
    exit($json = json_encode($response));
}

// hash password
$password = hash("sha256", $password);
$password .= "hjdfdcigyudodgfdj";
$password = hash("sha256", $password);
$password .= "mihddkfdskdstsdjj";
$password = hash("sha256", $password);

// checking password if exist
$check_password_sql = "SELECT password FROM users WHERE username =? ";
$select = $mysqli->prepare($check_password_sql);
$select->bind_param("s", $username);
$select->execute();
$check_possword = $select->get_result()->fetch_object()->password;
if($password != $check_possword) {
    $response["status"] = "wrong password";
    exit($json = json_encode($response));
}

// logging in
$response["status"] = "correct";

$get_user_id_sql = "SELECT id FROM users WHERE username =? ";
$select = $mysqli->prepare($get_user_id_sql);
$select->bind_param("s", $username);
$select->execute();
$id = $select->get_result()->fetch_object()->id;

$response["user_id"] = $id;

echo json_encode($response);

?>