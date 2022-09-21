<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
// Get all parameters using POST method
if(isset($_POST['product_name'])){
    $product_name=$_POST['product_name'];
    $about=$_POST['about'];
    $price=$_POST['price'];
    $category_id=$_POST['category_id'];
    $seller_id=$_POST['seller_id'];
    $array=json_decode($_POST['array']);
    $current_time = date ("Y-m-d H:m:s");

    // Insert all the parameters into products table.
    $add_product=$mysqli->prepare("INSERT INTO products(product_name,about,created_at,price,category_id,seller_id) VALUES (?,?,?,?,?,?)");
    $add_product->bind_param("ssssss",$product_name,$about,$current_time,$price,$category_id,$seller_id);
    $response=[];
    // Now, if the above query has been executed, we have to get last inserted id and save images.
    if($add_product->execute()){
        // Get last inserted id in order to be filled into product_id in table images.
        $product_id= mysqli_insert_id($mysqli);
        // Path of all images at server side.
        $path="images/product_images/";
        // Loop over all the images enocoded 
        foreach($array as $arr){
            // Get the final path from saveImage fuction of each image
           $final_path=saveImage($arr,$path);
            //Insert $final_path and the inserted id into images table
           $add_image=$mysqli->prepare("INSERT INTO images(image,product_id) VALUES(?,?)");
           $add_image->bind_param("ss",$final_path,$product_id);
           if($add_image->execute()){
                $response['status']='done';
           }else{
                $response['status']='error';
           }
        }

    }else{
        $response['status']='error';
    }
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