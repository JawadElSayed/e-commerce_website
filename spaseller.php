<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
// if(isset($_POST['id'])){
    // // Get all parameters using POST method
    // $id=$_POST['id'];
    $id=1;
    $whole_response=[];
    $whole_response['profile']= getProfile($id);
    $whole_response['ads']= getAds($id);
    $whole_response['categories']=getCategories($id);
    echo json_encode($whole_response,JSON_UNESCAPED_SLASHES);
// }

function getProfile($id){
    include("connection.php");
    $get_profile=$mysqli->prepare("SELECT `profile`,`name` FROM users WHERE `id`= ? LIMIT 1");
    $get_profile->bind_param("s",$id);
    $get_profile->execute();
    $array_get_profile=$get_profile->get_result()->fetch_assoc();
    $response_get_profile=[];
    $response_get_profile['image']=$array_get_profile['profile'];
    $response_get_profile['name']=$array_get_profile['name'];
    return $response_get_profile;
}

function getAds($id){
    include("connection.php");
    $get_ads=$mysqli->prepare("SELECT `id`,`image`,`title` FROM ads WHERE `seller_id`= ?");
    $get_ads->bind_param("s",$id);
    $get_ads->execute();
    $array_get_ads=$get_ads->get_result();
    $response_get_ads=[];
    while($a = $array_get_ads->fetch_assoc()){
        $response_get_ads[]=$a;
    }
    return $response_get_ads;
}

function getCategories($id){
    include("connection.php");
    $get_categories=$mysqli->prepare("SELECT categories.id,categories.category_name FROM 
    categories,sellers_categories 
    WHERE categories.id=sellers_categories.category_id and sellers_categories.seller_id=?");
    $get_categories->bind_param("s",$id);
    $get_categories->execute();
    $array_get_categories=$get_categories->get_result();
    $return_get_categories=[];
    $response_get_categories=[];
    while($a = $array_get_categories->fetch_assoc()){
        $return_get_categories['id']=$a['id'];
        $return_get_categories['category_name']=$a['category_name'];
        $response_get_categories[]=$return_get_categories;
    }
    return $response_get_categories;
}
?>