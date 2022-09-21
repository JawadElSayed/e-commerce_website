<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
// Get all parameters using POST method
if(isset($_POST['id'])){
    $id=$_POST['id'];
    $image=$_POST['image'];
    $text=$_POST['text'];

    // Insert image details to ads table
    $add_image=$mysqli->prepare("INSERT INTO ads(text,seller_id) VALUES(?,?)");
    $add_image->bind_param("ss",$text,$id);
    $response=[];
    // Now, if the above query has been executed, we have to get last inserted id and save the advertisment image. 
    if($add_image->execute()){
        // Get last inserted id in order to be filled into client_id in table ads.
        $image_id= mysqli_insert_id($mysqli);
        // Path of all ads images at server side.
        $image_path="images/ads/";
        // Get the final path from saveImage fuction of advertisment image. 
        $final_path=saveImage($image,$image_path);
        // Since we are not adding into another table, we have to update the same row of the same table we have added through first query by updating the image url.
        $update_path=$mysqli->prepare("UPDATE ads SET image = ? WHERE id = ?");
        $update_path->bind_param("ss",$final_path,$image_id);
        // If the above query will be executed, the response should be done, otherwise, it will be error.
        if($update_path->execute()){
            $response['status']="done";
        }else{
            $response['status']="error";
        }
        
    }else{
        $response['status']="error";
    }
    echo json_encode($response);
}

// Decode image, put it into the required path and return final url of it.
function saveImage($base64, $path){
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