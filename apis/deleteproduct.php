<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");

if(isset($_POST['id'])){
    // Get all parameters using POST method
    $id=$_POST['id'];

    // First, we have to delete the product from products table
    $clear_rows=$mysqli->prepare("DELETE FROM products WHERE id=? LIMIT 1");
    $clear_rows->bind_param("s",$id);
    $resonse=[];
    if($clear_rows->execute()){
        // Second step is to get all the images' paths of the specific product
        $get_files_names=$mysqli->prepare("SELECT `image` FROM images WHERE product_id=?");
        $get_files_names->bind_param("s",$id);
        $get_files_names->execute();
        $array=$get_files_names->get_result();
        // Third step is to delete these paths
        while($a = $array->fetch_assoc()){
            unlink($a['image']);
        }
        // Last step is to delete all images rows of the specific product
        $clear_images_rows=$mysqli->prepare("DELETE FROM images WHERE product_id=?");
        $clear_images_rows->bind_param("s",$id);
        // If all done, we have to return done, otherwise, we have to return error
        if($clear_images_rows->execute()){
            $resonse['status']='done';
        }else{
            $resonse['status']='error';
        }
    }else{
        $resonse['status']='error';
    }
    echo json_encode($resonse);
}