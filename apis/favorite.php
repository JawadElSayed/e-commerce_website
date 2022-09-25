<?php

include("connection.php");

// inputs
$client_id = $_POST["client_id"];
$product_id = $_POST["product_id"];
$response = [];

// add favorite or unfavorite
$favorite_sql = "INSERT INTO favorite(client_id, product_id) VALUE (?, ?)";
$add = $mysqli->prepare($favorite_sql);
$add->bind_param("ss",$client_id, $product_id);
if ($add->execute() === TRUE) {
    $response["status"] = "favorite";
    echo json_encode($response);
    exit();
} 
else {
    $unfavorite_sql = "DELETE FROM favorite WHERE client_id = ? and product_id = ?";
    $remove = $mysqli->prepare($unfavorite_sql);
    $remove->bind_param("ss",$client_id, $product_id);
    if ($remove->execute() === TRUE) {
        $response["status"] = "unfavorite";
        echo json_encode($response);
        exit();
    } 
    else {
        $response["success"] = "Error : " . mysqli_error($mysqli);
        echo json_encode($response);
        exit();
    }
}

?>