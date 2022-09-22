<?php

include("connection.php");

// variables
$search = '%' . $_GET["search"] . '%';
$response = [];

// add to cart
$search_sql = "SELECT id
                FROM `products`
                WHERE product_name LIKE ? OR about LIKE ?";
$select = $mysqli->prepare($search_sql);
$select->bind_param("ss", $search, $search);
$select->execute();
$array = $select->get_result();

while($a = $array->fetch_assoc()){
    $response[] .= $a["id"];
}

echo json_encode($response);

?>