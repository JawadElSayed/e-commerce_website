<?php

include("connection.php");

// variables
$client_id = $_POST["client_id"];
$product_id = $_POST["product_id"];

// add to cart
$add_sql = "INSERT INTO wish_list(client_id, product_id) VALUE (?, ?)";
$add = $mysqli->prepare($add_sql);
$add->bind_param("ss", $client_id, $product_id);
$add->execute();

$response["status"] = "Done";

echo json_encode($response);

?>