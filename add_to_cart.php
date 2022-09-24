<?php

include("connection.php");

// variables
$client_id = $_POST["client_id"];
$product_id = $_POST["product_id"];
$quantity = $_POST["quantity"];

// calculate price
$price_sql = "SELECT price FROM products WHERE id = ?";
$select = $mysqli->prepare($price_sql);
$select->bind_param("s", $product_id);
$select->execute();
$price = $select->get_result()->fetch_object()->price;
$total_price = $price * $quantity;

// add to cart
$add_sql = "INSERT INTO cart(client_id, product_id, quantity, total_price) VALUE (?, ?, ?, ?)";
$add = $mysqli->prepare($add_sql);
$add->bind_param("ssss", $client_id, $product_id, $quantity, $total_price);
$add->execute();

$response["status"] = "Done";

echo json_encode($response);

?>