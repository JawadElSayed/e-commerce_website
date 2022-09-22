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

?>