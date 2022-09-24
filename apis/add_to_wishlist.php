<?php

include("connection.php");

// variables
$client_id = $_POST["client_id"];
$product_id = $_POST["product_id"];

// get price
$price_sql = "SELECT price FROM products WHERE id = ?";
$select = $mysqli->prepare($price_sql);
$select->bind_param("s", $product_id);
$select->execute();
$price = $select->get_result()->fetch_object()->price;

// add to wishlist
$add_sql = "INSERT INTO wish_list(client_id, product_id, total_price) VALUE (?, ?, ?)";
$add = $mysqli->prepare($add_sql);
$add->bind_param("sss", $client_id, $product_id, $price);
$add->execute();

$response["status"] = "Done";

echo json_encode($response);

?>