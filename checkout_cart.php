<?php

include("connection.php");

// variables
$client_id = $_POST["client_id"];
$response = [];

// select cart
$select_sql = "SELECT client_id, product_id, quantity 
            FROM `cart` 
            WHERE client_id = ?";
$select = $mysqli->prepare($select_sql);
$select->bind_param("s", $client_id,);
$select->execute();
$array = $select->get_result();

while($a = $array->fetch_assoc()){
    $response[] = $a;
}

echo json_encode($response);

?>