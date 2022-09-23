<?php

include("connection.php");

// variables
$product_id = $_POST["product_id"];
$discount_code = $_POST["discount_code"];
$response = [];

// checking discount
$sql = "SELECT products.price, discount_codes.discount_amount
        FROM `products`
        INNER JOIN discount_codes ON products.id = discount_codes.product_id
        WHERE products.id = ? AND discount_codes.discount_code = ?";
$select = $mysqli->prepare($sql);
$select->bind_param("ss", $product_id, $discount_code);
$select->execute();
$code_check = $select->get_result();

if(!(mysqli_num_rows($code_check))) {
    $response["status"] = "invalid code";
    exit(json_encode($response));
}

// apply discound

while($a = $code_check->fetch_assoc()){
    $new_price = $a["price"] - $a["price"] * $a["discount_amount"] / 100 ;
}

$response["status"] = "correct";
$response["new_price"] = $new_price;

echo json_encode($response);

?>