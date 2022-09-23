<?php

include("connection.php");

// varibles
$client_id = $_POST["client_id"];
$response = [];

// getting profile name and image
function profile($mysqli, $id){
    $profile_response = [];
    $profile_sql = "SELECT name, profile FROM users WHERE id = ?";
    $select = $mysqli->prepare($profile_sql);
    $select->bind_param("s", $id);
    $select->execute();
    $array = $select->get_result()->fetch_assoc();
    $profile_response["name"] = $array["name"];
    $profile_response["profile"] = $array["profile"];
    return $profile_response;
}


echo json_encode(profile($mysqli, $client_id), JSON_UNESCAPED_SLASHES);


?>