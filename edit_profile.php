<?php

include("connection.php");

// variables
$client_id = $_POST["client_id"];
$name = $_POST["name"];
$profile = $_POST["profile"];

// decode image funxtion
function decode_image ($base64, $path){
    $base64 = explode( ',', $base64 );
    $ext = explode( '/', $base64[0] );
    $ext = explode( ';', $ext[1] );
    $ext = $ext[0];
    $image = $base64[1];
    $data = base64_decode($image);
    $file = $path . uniqid() . '.' . $ext;
    $success = file_put_contents($file, $data);
    return $file;
}

// encode image
function encode_image ($path){
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = "data:image/" . $ext . ";base64," . base64_encode($data);
    return $base64;
}

// checking change of profile image
$old_profile_sql = "SELECT profile FROM users WHERE id = ?";
$old_profile_url = $mysqli->prepare($old_profile_sql);
$old_profile_url->bind_param("s", $client_id);
$old_profile_url->execute();
$old_profile = $old_profile_url->get_result()->fetch_object()->profile;
$old_profile_base64 = encode_image($old_profile);

if ($profile != $old_profile_base64){
    $new_profile_img = decode_image($profile,"images/profile/");
}
else{
    $new_profile_img = $old_profile;
}

// set update
$update_sql = "UPDATE users
                SET name = ?,
                profile = ?
                WHERE id = ?";
$add = $mysqli->prepare($update_sql);
$add->bind_param("sss", $name, $new_profile_img, $client_id);
$add->execute();

$response["status"] = "Done";

echo json_encode($response);

?>