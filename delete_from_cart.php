<?php

include("connection.php");

// variables
$client_id = $_POST["client_id"];
$product_id = $_POST["product_id"];

// add to cart
$remove_sql = "DELETE FROM cart 
                WHERE client_id = ? AND product_id = ? ";
$add = $mysqli->prepare($remove_sql);
$add->bind_param("ss", $client_id, $product_id);
$add->execute();

$response["status"] = "Done";

echo json_encode($response);

?>