<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");

// The below function will return profile and name of a seller
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
// The below function will return all the ads and their images and titles.
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
// The below function will return all the categories names and ids.
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
// The below function will return all the ads and the discounts ids, codes, percentages and ids of a seller.
function getDiscounts($id){
    include("connection.php");
    date_default_timezone_set('Asia/Beirut');
    $current_time = date ("Y-m-d");
    $get_discounts=$mysqli->prepare("SELECT * FROM discount_codes WHERE discount_codes.seller_id=? AND discount_codes.end_at>=?");
    $get_discounts->bind_param('ss',$id,$current_time);
    $get_discounts->execute();
    $array_get_discounts=$get_discounts->get_result();
    $return_get_discounts=[];
    $response_get_discounts=[];
    while($a = $array_get_discounts->fetch_assoc()){
        $return_get_discounts['id']=$a['id'];
        $return_get_discounts['discount_code']=$a['discount_code'];
        $return_get_discounts['discount_percentage']=$a['discount_percentage'];
        $return_get_discounts['product_id']=$a['product_id'];
        $response_get_discounts[]=$return_get_discounts;
    }
    return $response_get_discounts;
}
// The below function will return all the products and their ids, names, prices, descriptions (about),
// and all image for every product of a seller.
function getProducts($id){
    include("connection.php");
    $get_products=$mysqli->prepare("SELECT DISTINCT products.id,products.product_name,products.about,products.price,categories.category_name
    FROM products,categories,sellers_categories
    WHERE products.seller_id=? AND products.category_id=categories.id");
    $get_products->bind_param('s',$id);
    $get_products->execute();
    $array_get_products=$get_products->get_result();
    $return_get_products=[];
    $response_get_products=[];
    while($a = $array_get_products->fetch_assoc()){
        $return_get_products['id']=$a['id'];
        $return_get_products['product_name']=$a['product_name'];
        $return_get_products['about']=$a['about'];
        $return_get_products['price']=$a['price'];
        $return_get_products['category_name']=$a['category_name'];
        $get_images = $mysqli->prepare("SELECT id,image FROM images WHERE product_id=?");
        $get_images->bind_param('s',$a['id']);
        $get_images->execute();
        $array_get_images=$get_images->get_result();
        $return_get_images=[];
        $r=[];
        while($b = $array_get_images->fetch_assoc()){
            $return_get_images['id']=$b['id'];
            $return_get_images['image']=$b['image'];
            $r[]=$return_get_images;
        }
        $return_get_products['images']=$r;
        $response_get_products[]=$return_get_products;
    }
    return $response_get_products;
}
// The below function will return all the top 5 viewed products and the number of views of a seller.
function getViews($id){
    include("connection.php");
    $get_views=$mysqli->prepare("SELECT COUNT(views.product_id) as num,views.product_id
    FROM views,products
    WHERE products.seller_id=? AND views.product_id=products.id
    GROUP BY views.product_id ASC LIMIT 5");
    $get_views->bind_param('s',$id);
    $get_views->execute();
    $array_get_views=$get_views->get_result();
    $return_get_views=[];
    $response_get_products=[];
    while($a = $array_get_views->fetch_assoc()){
        $return_get_views['num']=$a['num'];
        $return_get_views['id']=$a['product_id'];
        $response_get_products[]=$return_get_views;
    }
    return $response_get_products;
}
// The below function will return all the revenue of a certain period
function getRevenue($id){
    include("connection.php");
    $response_revenue=[];
    // The below function will return the  revenue of last week of a seller, wich is about the quantity
    // of each product sold out multuplied by the price and added to the total price.
    $get_weekly_revenue=$mysqli->prepare("SELECT SUM(checkouts.quantity*products.price) as weekly_revernue
    FROM checkouts,products 
    WHERE checkouts.product_id=products.id AND products.seller_id=? AND ABS(DATEDIFF(NOW(),checkouts.created_at))<=7");
    $get_weekly_revenue->bind_param('s',$id);
    $get_weekly_revenue->execute();
    $return_weekly_revenue=$get_weekly_revenue->get_result()->fetch_assoc();
    // If the return was NULL, we have to return in as 'zero'.
    if($return_weekly_revenue['weekly_revernue']!=NULL)
        $response_revenue['weekly']=$return_weekly_revenue['weekly_revernue'];
    else{
        $response_revenue['weekly']="0";
    }

    // The below function will return the  revenue of last month of a seller, wich is about the quantity
    // of each product sold out multuplied by the price and added to the total price.    
    $get_monthly_revenue=$mysqli->prepare("SELECT SUM(checkouts.quantity*products.price) as monthly_revernue
    FROM checkouts,products 
    WHERE checkouts.product_id=products.id AND products.seller_id=? AND ABS(DATEDIFF(NOW(),checkouts.created_at))<=30");
    $get_monthly_revenue->bind_param('s',$id);
    $get_monthly_revenue->execute();
    $return_monthly_revenue=$get_monthly_revenue->get_result()->fetch_assoc();
    // If the return was NULL, we have to return in as 'zero'.
    if($return_monthly_revenue['monthly_revernue']!=NULL)
        $response_revenue['monthly']=$return_monthly_revenue['monthly_revernue'];
    else
        $response_revenue['monthly']="0";

    // The below function will return the  revenue of last year of a seller, wich is about the quantity
    // of each product sold out multuplied by the price and added to the total price.
    $get_yearly_revenue=$mysqli->prepare("SELECT SUM(checkouts.quantity*products.price) as yearly_revernue
    FROM checkouts,products 
    WHERE checkouts.product_id=products.id AND products.seller_id=? AND ABS(DATEDIFF(NOW(),checkouts.created_at))<=365");
    $get_yearly_revenue->bind_param('s',$id);
    $get_yearly_revenue->execute();
    $return_yearly_revenue=$get_yearly_revenue->get_result()->fetch_assoc();
    // If the return was NULL, we have to return in as 'zero'.
    if($return_yearly_revenue['yearly_revernue']!=NULL)
        $response_revenue['yearly']=$return_yearly_revenue['yearly_revernue'];
    else
        $response_revenue['yearly']="0";
    return $response_revenue;
}
if(isset($_POST['id'])){
    // Get id using POST method
    $id=$_POST['id'];
    $whole_response=[];
    $whole_response['profile']= getProfile($id);
    $whole_response['ads']= getAds($id);
    $whole_response['categories']=getCategories($id);
    $whole_response['discounts']=getDiscounts($id);
    $whole_response['products']=getProducts($id);
    $whole_response['views']=getViews($id);
    $whole_response['revenue']=getRevenue($id);
    echo json_encode($whole_response,JSON_UNESCAPED_SLASHES);



}
?>
