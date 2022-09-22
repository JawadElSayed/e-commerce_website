<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
// Get all parameters using POST method
if(isset($_POST['category_name'])){
    $category_name=$_POST['category_name'];
    $id=$_POST['id'];
    // insert category_name into categories table
    $query=$mysqli->prepare("SELECT id FROM categories WHERE categories.category_name=? LIMIT 1");
    $query->bind_param("s",$category_name);
    $query->execute();
    // Here, we have to check if this category is created before. So, if it's not created before,
    // it will create a new row in category table and get this id and add it ith id of seller to 
    // seller_categories table
    $return = $query->get_result();
    $rows= mysqli_num_rows($return);
    $return= $return->fetch_assoc();
    $response=[];
    // If the number of row = 0, so, this category name isn't existed before
    if($rows==0){
        // Insert this category name to categories table
        $add_category=$mysqli->prepare("INSERT INTO categories(category_name) VALUES(?)");
        $add_category->bind_param("s",$category_name);
        $add_category->execute();
        // Get the last id inserted
        $category_id=mysqli_insert_id($mysqli);
    // If the number of row = 1, so, this category name isn existed before    
    }else{
        // Get category name's id
        $category_id=$return['id'];
    }
    // Insert the seller id and the id of category name to sellers_categories table
    $add_category_seller=$mysqli->prepare("INSERT INTO sellers_categories(category_id,seller_id) VALUES (?,?)");
    $add_category_seller->bind_param("ss",$category_id,$id);
    // In case the last query has been executed, the response wil be done, otherwise, that means 
    // a seller is trying to create an existed category name 
    if($add_category_seller->execute()){
        $response['status']="done";
    }else{
        $response['status']="category_is_created";
    }
    echo json_encode($response);
    
}