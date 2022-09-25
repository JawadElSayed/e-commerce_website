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

// ban case
$check_ban_sql = "SELECT client_id
                FROM `ban`
                INNER JOIN users ON client_id = users.id
                WHERE users.username = ?";
$select = $mysqli->prepare($check_ban_sql);
$select->bind_param("s", $username);
$select->execute();
$check_ban = $select->get_result();

if(mysqli_num_rows($check_ban)) {
    $response["status"] = "banned";
    exit($json = json_encode($response));
}

// logging in
$response["status"] = "correct";


$get_user_id_sql = "SELECT id, user_type FROM users WHERE username =? ";
$select = $mysqli->prepare($get_user_id_sql);
$select->bind_param("s", $username);
$select->execute();
$array = $select->get_result();

while ($a = $array->fetch_assoc()){
    $id = $a["id"];
    $user_type = $a["user_type"];
}

$response["user_id"] = $id;
$response["user_type"] = $user_type;

echo json_encode($response);

?>