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
function getSellers(){
    include("connection.php");
    $get_users=$mysqli->prepare("SELECT * FROM users WHERE users.user_type=2");
    $get_users->execute();
    $array_get_users=$get_users->get_result();
    $response_get_users=[];
    $return_get_users=[];
    while($a = $array_get_users->fetch_assoc()){
        $return_get_users['id']=$a['id'];
        $return_get_users['email']=$a['email'];
        $return_get_users['name']=$a['name'];
        $return_get_users['username']=$a['username'];
        $return_get_users['profile']=$a['profile'];
        $response_get_users[]=$return_get_users;
    }
    return $response_get_users;
}

function getClients(){
    include("connection.php");
    $get_users=$mysqli->prepare("SELECT * FROM users WHERE users.user_type=3");
    $get_users->execute();
    $array_get_users=$get_users->get_result();
    $response_get_users=[];
    $return_get_users=[];
    while($a = $array_get_users->fetch_assoc()){
        $return_get_users['id']=$a['id'];
        $return_get_users['email']=$a['email'];
        $return_get_users['name']=$a['name'];
        $return_get_users['username']=$a['username'];
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
    if($array_best_seller_week['name']!=NULL){
        $response_get_best_sellers['weekly']=$array_best_seller_week['name'];
    }
    else{
        $response_get_best_sellers['weekly']="No one yet";
    }    

    $best_seller_month=$mysqli->prepare("SELECT SUM(checkouts.quantity) as total,users.name
    FROM checkouts,users,products 
    WHERE checkouts.product_id=products.id AND products.seller_id=users.id AND ABS(DATEDIFF(NOW(),checkouts.created_at))<=30
    GROUP BY checkouts.product_id 
    ORDER BY total DESC lIMIT 1");
    $best_seller_month->execute();
    $array_best_seller_month=$best_seller_month->get_result()->fetch_assoc();

    if($array_best_seller_month['name']!=NULL){
        $response_get_best_sellers['monthly']=$array_best_seller_month['name']; 
    }
    else{
        $response_get_best_sellers['monthly']="No one yet";
    }   
    

    $best_seller_year=$mysqli->prepare("SELECT SUM(checkouts.quantity) as total,users.name
    FROM checkouts,users,products 
    WHERE checkouts.product_id=products.id AND products.seller_id=users.id AND ABS(DATEDIFF(NOW(),checkouts.created_at))<=365
    GROUP BY checkouts.product_id 
    ORDER BY total DESC lIMIT 1");
    $best_seller_year->execute();
    $array_best_seller_year=$best_seller_year->get_result()->fetch_assoc();

    if($array_best_seller_year['name']!=NULL){
        $response_get_best_sellers['yearly']=$array_best_seller_year['name']; 
    }
    else{
        $response_get_best_sellers['yearly']="No one yet";
    }   
    


    return $response_get_best_sellers;
}




function getBestClient(){
    include("connection.php");
    $response_get_best_clients=[];
    $best_client_week=$mysqli->prepare("SELECT COUNT(checkouts.client_id) as total,users.name
    FROM checkouts,users
    WHERE checkouts.client_id=users.id AND ABS(DATEDIFF(NOW(),checkouts.created_at))<=7
    GROUP BY checkouts.client_id 
    ORDER BY total DESC LIMIT 1");
    $best_client_week->execute();
    $array_best_client_week=$best_client_week->get_result()->fetch_assoc();
    if($array_best_client_week['name']!=NULL){
        $response_get_best_clients['weekly']=$array_best_client_week['name'];
    }
    else{
        $response_get_best_clients['weekly']="No one yet";
    }    

    $best_client_month=$mysqli->prepare("SELECT COUNT(checkouts.client_id) as total,users.name
    FROM checkouts,users
    WHERE checkouts.client_id=users.id AND ABS(DATEDIFF(NOW(),checkouts.created_at))<=30
    GROUP BY checkouts.client_id 
    ORDER BY total DESC LIMIT 1");
    $best_client_month->execute();
    $array_best_client_month=$best_client_month->get_result()->fetch_assoc();

    if($array_best_client_month['name']!=NULL){
        $response_get_best_clients['monthly']=$array_best_client_month['name']; 
    }
    else{
        $response_get_best_clients['monthly']="No one yet";
    }   
    

    $best_client_year=$mysqli->prepare("SELECT COUNT(checkouts.client_id) as total,users.name
    FROM checkouts,users
    WHERE checkouts.client_id=users.id AND ABS(DATEDIFF(NOW(),checkouts.created_at))<=365
    GROUP BY checkouts.client_id 
    ORDER BY total DESC LIMIT 1");
    $best_client_year->execute();
    $array_best_client_year=$best_client_year->get_result()->fetch_assoc();

    if($array_best_client_year['name']!=NULL){
        $response_get_best_clients['yearly']=$array_best_client_year['name']; 
    }
    else{
        $response_get_best_clients['yearly']="No one yet";
    }   
    


    return $response_get_best_clients;
}

function numbers(){
    include("connection.php");
    $response_number=[];
    $products_number=$mysqli->prepare("SELECT COUNT(id) as total FROM products");
    $products_number->execute();
    $return_products_number=$products_number->get_result()->fetch_assoc();
    if($return_products_number['total']!=NULL){
        $response_number['products']=$return_products_number['total'];
    }else{
        $response_number['products']="0";
    }

    $sellers_number=$mysqli->prepare("SELECT COUNT(id) as total FROM users WHERE user_type=2");
    $sellers_number->execute();
    $return_sellers_number=$sellers_number->get_result()->fetch_assoc();
    if($return_sellers_number['total']!=NULL){
        $response_number['sellers']=$return_sellers_number['total'];
    }else{
        $response_number['sellers']="0";
    }

    $clients_number=$mysqli->prepare("SELECT COUNT(id) as total FROM users WHERE user_type=3");
    $clients_number->execute();
    $return_clients_number=$clients_number->get_result()->fetch_assoc();
    if($return_clients_number['total']!=NULL){
        $response_number['clients']=$return_clients_number['total'];
    }else{
        $response_number['clients']="0";
    }

    return $response_number;
}
function getViews(){
    include("connection.php");
    $get_views=$mysqli->prepare("SELECT DAY(created_at) as day,COUNT(views.created_at) as views
    FROM views 
    WHERE ?<=views.created_at AND views.created_at<=? 
    GROUP BY views.created_at ASC");
    $first_date=date('Y-m-01');
    $last_date=date('Y-m-31');
    $get_views->bind_param("ss",$first_date,$last_date);
    $get_views->execute();
    $response_get_views=[];
    $array_get_views=$get_views->get_result();
    $return_get_view=[];
    while ($a = $array_get_views->fetch_assoc()) {
        $return_get_view['day']=$a['day'];
        $return_get_view['views']=$a['views'];
        $response_get_views[]=$return_get_view;
    }
    return $response_get_views;
}
function getChart(){
    include("connection.php");
    $get_top_sellers=$mysqli->prepare("SELECT users.username,COUNT(products.seller_id) as total
    FROM products,users
    WHERE products.seller_id=users.id
    GROUP BY products.seller_id ASC LIMIT 5");
    $get_top_sellers->execute();
    $array_get_top_sellers=$get_top_sellers->get_result();
    $return_get_top_sellers=[];
    $response_get_top_sellers=[];
    $total_products=array_values(numbers())[0];
    $total_percentage=0;
    while($a = $array_get_top_sellers->fetch_assoc()){
        $percentage=($a['total']*100)/$total_products;
        $percentage=number_format((float)$percentage, 2, '.', '');
        $total_percentage+=$percentage;
        $return_get_top_sellers['username']=$a['username'];
        $return_get_top_sellers['percentage']=$percentage;
        $response_get_top_sellers[]=$return_get_top_sellers;
    }
    $return_get_top_sellers['username']="others";
    $return_get_top_sellers['percentage']=number_format((float)(100-$total_percentage), 2, '.', '');;
    $response_get_top_sellers[]=$return_get_top_sellers;
    return $response_get_top_sellers;

}

// if(isset($_POST['id'])){
    $id=1;
    $response=[];
    $response['profile']=getProfile($id);
    $response['sellers']=getSellers();
    $response['clients']=getClients();
    $response['best_seller']=getBestSeller();
    $response['best_client']=getBestClient();
    $response['numbers']=numbers();
    $response['view']=getViews();
    $response['chart']=getChart();
    echo json_encode($response,JSON_UNESCAPED_SLASHES);
    
// }
?>