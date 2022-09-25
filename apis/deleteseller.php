<?php 
include("connection.php");

if(isset($_POST['id'])){
    // Get id using POST method
    $id=$_POST['id'];
    // Get all images of every product related to this seller
    $get_images=$mysqli->prepare("SELECT `image`
    FROM images,products
    WHERE products.seller_id=? AND products.id=images.product_id");
    $get_images->bind_param("s",$id);
    $get_images->execute();
    $array_get_images=$get_images->get_result();
    // Delte all the images returned by the above query
    while($a = $array_get_images->fetch_assoc()){
        unlink($a['image']);
    }
    // Delete all the rows of every image related to this seller in images table into DataBase
    $delete_rows_images=$mysqli->prepare("DELETE FROM images WHERE images.product_id IN (SELECT products.id FROM products WHERE products.seller_id=?)");
    $delete_rows_images->bind_param("s",$id);
    $delete_rows_images->execute();  
    // Delete all the rows of product related to this seller in product table into DataBase
    $delete_rows_products=$mysqli->prepare("DELETE FROM products WHERE products.seller_id=?");
    $delete_rows_products->bind_param("s",$id);
    $delete_rows_products->execute();  
    // Get profile picture path in order to be deleted later on.
    $get_profile=$mysqli->prepare("SELECT `profile` FROM users WHERE id =? LIMIT 1");
    $get_profile->bind_param("s",$id);
    $get_profile->execute();
    $return_get_profile=$get_profile->get_result()->fetch_assoc();
    // Delete the profile photo returned by the above query
    unlink($return_get_profile['profile']);
    // Delete the row existed into users table into DataBase.
    $delete_row_user=$mysqli->prepare("DELETE FROM users WHERE id = ? LIMIT 1");
    $delete_row_user->bind_param("s",$id);
    $response=[];
    if($delete_row_user->execute()){
        $response['status']="done";
    }else{
        $response['status']="error";
    }
    echo json_encode($response);
    }
?>