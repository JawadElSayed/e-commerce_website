<?php

include("connection.php");

$response = array();

// getting categories 
$sql = "SELECT id, category_name
        FROM `categories`";
$query = $mysqli->prepare($sql);
$query->execute();
$array = $query->get_result();

while($res = mysqli_fetch_array($array)) {
    $response[$res["id"]] = $res["category_name"];
}

echo json_encode($response);

?>