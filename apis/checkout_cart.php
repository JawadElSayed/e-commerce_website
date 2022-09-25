<?php

include("connection.php");

// variables
$client_id = $_POST["client_id"];
$result = [];
$response = [];

// select cart
$select_sql = "SELECT product_id, quantity, total_price
            FROM `cart` 
            WHERE client_id = ?";
$select = $mysqli->prepare($select_sql);
$select->bind_param("s", $client_id,);
$select->execute();
$array = $select->get_result();

while($a = $array->fetch_assoc()){
    $result[] = $a;
}

// add to checkout table
$add_sql = "INSERT INTO checkouts(client_id, product_id, quantity, total_price) VALUE (?, ?, ?, ?)";
$add = $mysqli->prepare($add_sql);

foreach ($result as $value){
    $add->bind_param("ssss", $client_id, $value["product_id"], $value["quantity"], $value["total_price"]);
    $add->execute();
}

// delete from cart
$delete_sql = "DELETE FROM cart WHERE client_id = ?";
$delete = $mysqli->prepare($delete_sql);
$delete->bind_param("s", $client_id);
$delete->execute();

$response["status"] = "Done";
echo json_encode($response);

?>