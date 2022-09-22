<?php

include("connection.php");

// variables
$client_id = $_POST["client_id"];
$product_id = $_POST["product_id"];
$quantity = $_POST["quantity"];

// add to cart
$add_sql = "INSERT INTO cart(client_id, product_id, quantity) VALUE (?, ?, ?)";
$add = $mysqli->prepare($add_sql);
$add->bind_param("sss", $client_id, $product_id, $quantity);
$add->execute();

$response["status"] = "Done";

echo json_encode($response);

?>