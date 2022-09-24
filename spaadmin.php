<?php 
include("connection.php");

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
function getUser(){
    include("connection.php");
    $get_users=$mysqli->prepare("SELECT * FROM users WHERE users.user_type!=1");
    $get_users->execute();
    $array_get_users=$get_users->get_result();
    $response_get_users=[];
    $return_get_users=[];
    while($a = $array_get_users->fetch_assoc()){
        $return_get_users['id']=$a['id'];
        $return_get_users['email']=$a['email'];
        $return_get_users['name']=$a['name'];
        $return_get_users['username']=$a['username'];
        $return_get_users['user_type']=$a['user_type'];
        $return_get_users['profile']=$a['profile'];
        $response_get_users[]=$return_get_users;
    }
    return $response_get_users;
}

function getBestSeller(){
    include("connection.php");
    $response_get_best_sellers=[];
    $best_seller_week=$mysqli->prepare("SELECT SUM(checkouts.quantity) as total,users.name
    FROM checkouts,users,products 
    WHERE checkouts.product_id=products.id AND products.seller_id=users.id AND ABS(DATEDIFF(NOW(),checkouts.created_at))<=7
    GROUP BY checkouts.product_id 
    ORDER BY total DESC lIMIT 1");
    $best_seller_week->execute();
    $array_best_seller_week=$best_seller_week->get_result()->fetch_assoc();

    $response_get_best_sellers['weekly']=$array_best_seller_week['name']; 

    $best_seller_month=$mysqli->prepare("SELECT SUM(checkouts.quantity) as total,users.name
    FROM checkouts,users,products 
    WHERE checkouts.product_id=products.id AND products.seller_id=users.id AND ABS(DATEDIFF(NOW(),checkouts.created_at))<=30
    GROUP BY checkouts.product_id 
    ORDER BY total DESC lIMIT 1");
    $best_seller_month->execute();
    $array_best_seller_month=$best_seller_month->get_result()->fetch_assoc();


    $response_get_best_sellers['monthly']=$array_best_seller_month['name']; 

    $best_seller_year=$mysqli->prepare("SELECT SUM(checkouts.quantity) as total,users.name
    FROM checkouts,users,products 
    WHERE checkouts.product_id=products.id AND products.seller_id=users.id AND ABS(DATEDIFF(NOW(),checkouts.created_at))<=365
    GROUP BY checkouts.product_id 
    ORDER BY total DESC lIMIT 1");
    $best_seller_year->execute();
    $array_best_seller_year=$best_seller_year->get_result()->fetch_assoc();


    $response_get_best_sellers['yearly']=$array_best_seller_year['name']; 


    return $response_get_best_sellers;
}

// if(isset($_POST['id'])){
    $id=1;
    $response=[];
    $response['profile']=getProfile($id);
    $response['users']=getUser();
    $response['best_seller']=getBestSeller();
    echo json_encode($response,JSON_UNESCAPED_SLASHES);
// }
?>