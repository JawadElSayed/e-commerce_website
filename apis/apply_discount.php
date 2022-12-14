<?php

include("connection.php");

// variables
$client_id = $_POST["client_id"];
$product_id = $_POST["product_id"];
$discount_code = $_POST["discount_code"];
$page = $_POST["page"];
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

// check time
$time_sql = "SELECT end_at from discount_codes where discount_code = ?";
$select_end_time = $mysqli->prepare($time_sql);
$select_end_time->bind_param("s", $discount_code);
$select_end_time->execute();
$end_time = $select_end_time->get_result()->fetch_object()->end_at;
date_default_timezone_set("Asia/Beirut");

if (date("Y-m-d h:i:s") > $end_time){
    $response["status"] = "expired code";
    exit(json_encode($response));
}

// apply discound
while($a = $code_check->fetch_assoc()){
    $new_price = $a["price"] - $a["price"] * $a["discount_amount"] / 100 ;
}

// update price
if ($page == "wishlist"){
    $update_sql = "UPDATE wish_list
                    SET total_price = ?
                    WHERE product_id = ? AND client_id = ?";
    $update_price = $mysqli->prepare($update_sql);
    $update_price->bind_param("sss", $new_price, $product_id, $client_id);
    $update_price->execute();
    $response["status"] = "correct";
    $response["new_price"] = $new_price;
}
else{
    // getting quantity
    $quantity_sql = "SELECT quantity 
                        FROM cart 
                        WHERE client_id = ? AND product_id = ? ";
    $select_quantity = $mysqli->prepare($quantity_sql);
    $select_quantity->bind_param("ss", $client_id, $product_id);
    $select_quantity->execute();
    $quantity = $select_quantity->get_result()->fetch_object()->quantity;

    // update price
    $total_new_price = $new_price * $quantity;
    $update_sql = "UPDATE cart
                    SET total_price = ?
                    WHERE product_id = ? AND client_id = ?";
    $update_price = $mysqli->prepare($update_sql);
    $update_price->bind_param("sss", $total_new_price, $product_id, $client_id);
    $update_price->execute();
    $response["status"] = "correct";
    $response["new_price"] = $total_new_price;
}

echo json_encode($response);

?>