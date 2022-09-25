<?php

include("connection.php");

// variables
$client_id = $_POST["client_id"];
$product_id = $_POST["product_id"];
$quantity = 1;
$response = [];

// select product price from wishlist
$select_sql = "SELECT total_price
            FROM `wish_list` 
            WHERE client_id = ? AND product_id = ?";
$select = $mysqli->prepare($select_sql);
$select->bind_param("ss", $client_id, $product_id);
$select->execute();
$price = $select->get_result()->fetch_object()->total_price;

// add to checkout table
$add_sql = "INSERT INTO checkouts(client_id, product_id, quantity, total_price) VALUE (?, ?, ?, ?)";
$add = $mysqli->prepare($add_sql);
$add->bind_param("ssss", $client_id, $product_id, $quantity, $price);
$add->execute();

// delete from wishlist
$delete_sql = "DELETE FROM wish_list WHERE client_id = ? AND product_id = ?";
$delete = $mysqli->prepare($delete_sql);
$delete->bind_param("ss", $client_id, $product_id);
$delete->execute();

$response["status"] = "Done";
echo json_encode($response);

?>