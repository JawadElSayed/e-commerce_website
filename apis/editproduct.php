<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");

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

if(isset($_POST['id'])){
    // Get all parameters using POST method.
    $id=$_POST['id'];
    $product_name=$_POST['product_name'];
    $about=$_POST['about'];
    $price=$_POST['price'];
    $category_id=$_POST['category_id'];
    $array=json_decode($_POST['array']);
    $delete=json_decode($_POST['delete']);
    //Update all parameters in the product table
    $update_product=$mysqli->prepare("UPDATE products SET `product_name`=?,`about`= ?, `price`=?, `category_id`= ? WHERE id = ?");
    $update_product->bind_param("sssss",$product_name,$about,$price,$category_id,$id);
    $response=[];
    if($update_product->execute()){
        $path="images/products_images/";
        // Here, we have to see if the seller has added new images, so, we have to add them to images table into DataBase
        if(is_array($array) || is_object($array)){
            foreach($array as $arr){
                // Get the final path from saveImage fuction of each image
            $final_path=saveImage($arr,$path);
                //Insert $final_path and the inserted id into images table
            $add_image=$mysqli->prepare("INSERT INTO images(image,product_id) VALUES(?,?)");
            $add_image->bind_param("ss",$final_path,$id);
            $add_image->execute();  
            }
        }   
        // Here, we have to see if the seller has deleted old images, so, we have to delete them from images table and from images/products_images/
        if(is_array($delete) || is_object($delete)){
            foreach($delete as $id_image){
                $delte_images=$mysqli->prepare("SELECT image FROM images WHERE id =? LIMIT 1");
                $delte_images->bind_param("s",$id_image);
                $delte_images->execute();
                $delte_images=$delte_images->get_result()->fetch_assoc();
                unlink($delte_images['image']);

                $delte_images_rows=$mysqli->prepare("DELETE FROM images WHERE id = ?");
                $delte_images_rows->bind_param("s",$id_image);
                $delte_images_rows->execute();
            }
        }
        $response['status']='done'; 
    }else{
        $response['status']='error';
    }
    echo json_encode($response);
}