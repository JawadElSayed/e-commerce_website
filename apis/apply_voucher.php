<?php

include("connection.php");

$voucher_code = $_POST["code"];
$client_id = $_POST["client_id"];
$response = [];

$sql = "SELECT voucher_amount, used
        FROM vouchers
        WHERE voucher_code = ? AND resever_id = ?";
$select = $mysqli->prepare($sql);
$select->bind_param("ss", $voucher_code, $client_id);
$select->execute();
$code_check = $select->get_result();

while ($a = $code_check->fetch_assoc()){
    $amount = $a["voucher_amount"];
    $used = $a["used"];
}

// check code
if(!(mysqli_num_rows($code_check))) {
    $response["status"] = "invalid code";
    exit(json_encode($response));
}

// check code if used
if($used) {
    $response["status"] = "used code";
    exit(json_encode($response));
}

// update used
$update_sql = "UPDATE vouchers 
                SET used = 1 
                WHERE voucher_code = ? AND resever_id = ?";
$update = $mysqli->prepare($update_sql);
$update->bind_param("ss", $voucher_code, $client_id);
$update->execute();

$response["status"] = "correct";
$response["amount"] = $amount;

echo json_encode($response);

?>