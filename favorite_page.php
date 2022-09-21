<?php

include("connection.php");

// variables
$client_id = $_POST["client_id"];

// get product data
$favorite_sql = "SELECT product_name, price , images.image
                FROM `products`
                INNER JOIN favorite ON products.id = favorite.product_id
                INNER JOIN images ON products.id = images.product_id
                WHERE favorite.client_id = ?
                GROUP BY products.id";
$query = $mysqli->prepare($favorite_sql);
$query->bind_param("s", $client_id);
$query->execute();
$array = $query->get_result();

while($a = $array->fetch_assoc()){
    $response[] = $a;
}

echo json_encode($response, JSON_UNESCAPED_SLASHES);

?>