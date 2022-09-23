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

// getting ads
function get_ads ($mysqli){
    $ads_response = [];
    $ads_sql = "SELECT title, image FROM ads";
    $select = $mysqli->prepare($ads_sql);
    $select->execute();
    $array = $select->get_result();
    while ($a = $array->fetch_assoc()){
        $ads_response[] = $a;
    }
    return $ads_response;
}

// getting available categories
function categories($mysqli){
    $categories_response = [];
    $categories_sql = "SELECT * FROM categories";
    $select = $mysqli->prepare($categories_sql);
    $select->execute();
    $array = $select->get_result();
    while($a = $array->fetch_assoc()){
        $categories_response[] = $a;
    }
    return $categories_response;
}

echo json_encode(categories($mysqli), JSON_UNESCAPED_SLASHES);


?>