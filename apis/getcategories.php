<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
if(isset($_POST['id'])){
    // Get all parameters using POST method
    $id=$_POST['id'];

    // Get all categories ids and names of a specific seller
    $get_categories=$mysqli->prepare("SELECT categories.id,categories.category_name FROM 
    categories,sellers_categories 
    WHERE categories.id=sellers_categories.category_id and sellers_categories.seller_id=?");
    $get_categories->bind_param("s",$id);
    $response=[];
    // If the above query has been executed, the response must be done as status, in addition to ids and names of that specific seller
    if($get_categories->execute()){
        $array=$get_categories->get_result();
        $return=[];
        $return1=[];
        while($a = $array->fetch_assoc()){
            $return['id']=$a['id'];
            $return['category_name']=$a['category_name'];
            $return1[]=$return;
        }
        $response['status']="done";
        $response['return']=$return1;
    }else{
        $response['status']="error";
    }
    echo json_encode($response);
}