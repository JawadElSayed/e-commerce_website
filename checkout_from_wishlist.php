<?php

include("connection.php");

// variables
$client_id = $_POST["client_id"];
$product_id = $_POST["product_id"];
$quantity = 1;
$response = [];

// add to checkout table
$add_sql = "INSERT INTO checkouts(client_id, product_id, quantity) VALUE (?, ?, ?)";
$add = $mysqli->prepare($add_sql);
$add->bind_param("sss", $client_id, $product_id, $quantity);
$add->execute();

// delete from cart
$delete_sql = "DELETE FROM wish_list WHERE client_id = ? AND product_id = ?";
$delete = $mysqli->prepare($delete_sql);
$delete->bind_param("ss", $client_id, $product_id);
$delete->execute();

$response["status"] = "Done";
echo json_encode($response);

?>