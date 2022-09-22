<?php

include("connection.php");

// variables
$product_id = $_POST["product_id"];
$discount_code = $_POST["discount_code"];

echo $product_id;
echo $discount_code;

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

?>