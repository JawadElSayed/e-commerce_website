<?php

include("connection.php");

// inputs
$sender_id = $_POST["sender_id"];
$resever_username = $_POST["resever_username"];
$voucher_amount = $_POST["voucher_amount"];
$used = 0;
$response = [];

// check username
$sql = "SELECT username FROM users WHERE username = ?";
$select = $mysqli->prepare($sql);
$select->bind_param("s", $resever_username);
$select->execute();
$username_check = $select->get_result();

if(!(mysqli_num_rows($username_check))) {
    $response["status"] = "invalid";
    exit(json_encode($response));
}

// getting resever id
$resever_sql = "SELECT id FROM users WHERE username = ?";
$select = $mysqli->prepare($resever_sql);
$select->bind_param("s", $resever_username);
$select->execute();
$resever_id = $select->get_result()->fetch_object()->id;

// generat code
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $code = substr( str_shuffle( $chars ), 0, 5 );

// insert voucher
$add_sql = "INSERT INTO 
            vouchers (sender_id, resever_id, voucher_code, voucher_amount, used) 
            VALUES(?,?,?,?,?)";
$select = $mysqli->prepare($add_sql);
$select->bind_param("sssss", $sender_id, $resever_id, $code, $voucher_amount, $used);
$select->execute();

$response["code"] = $code;
echo json_encode($response);

?>