<?php

include("connection.php");

// variables
$client_id = $_POST["client_id"];
$new_password = $_POST["password"];
$response = [];

// hash password
$new_password = hash("sha256", $new_password);
$new_password .= "hjdfdcigyudodgfdj";
$new_password = hash("sha256", $new_password);
$new_password .= "mihddkfdskdstsdjj";
$new_password = hash("sha256", $new_password);

// update password data
$updaet_sql = "UPDATE users
                SET password = ?
                WHERE id = ?";
$update = $mysqli->prepare($updaet_sql);
$update->bind_param("ss", $new_password, $client_id);
$update->execute();

$response["status"] = "Done";

echo json_encode($response);

?>