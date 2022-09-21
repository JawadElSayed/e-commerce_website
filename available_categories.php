<?php

include("connection.php");

$response = [];

// getting categories 
$sql = "SELECT category_name
        FROM `categories`";
$query = $mysqli->prepare($sql);
$query->execute();
$array = $query->get_result();

while($a = $array->fetch_assoc()){
    $response[] .= $a["category_name"];
}

echo json_encode($response);

?>