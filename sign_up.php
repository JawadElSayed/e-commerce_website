<?php

include("connection.php");

// variables
$name = $_POST["name"];
$email = $_POST["email"];
$username = $_POST["username"];
$profile = "images/profile/default.png";
$user_type = $_POST["user_type"];
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

// password according to user type
if ($user_type == 3){
    $password = $_POST["password"];
}
else{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_./,@$";
    $password = substr( str_shuffle( $chars ), 0, 8 );
    $response["password"] = $password;
}

// hash password
$password = hash("sha256", $password);
$password .= "hjdfdcigyudodgfdj";
$password = hash("sha256", $password);
$password .= "mihddkfdskdstsdjj";
$password = hash("sha256", $password);

// insert data
$add = $mysqli->prepare("INSERT INTO users(name, email, username, password, profile, user_type) VALUE (?, ?, ?, ?, ?, ?)");
$add->bind_param("ssssss", $name, $email, $username, $password, $profile, $user_type);
$add->execute();

$response["status"] = "Done";

echo json_encode($response);

?>