<?php

include("connection.php");

// varibles
$client_id = $_POST["client_id"];
$response = [];

// getting profile name and image
function profile($mysqli, $id){
    $profile_response = [];
    $profile_sql = "SELECT name, profile FROM users WHERE id = ?";
    $select = $mysqli->prepare($profile_sql);
    $select->bind_param("s", $id);
    $select->execute();
    $array = $select->get_result()->fetch_assoc();
    $profile_response["name"] = $array["name"];
    $profile_response["profile"] = $array["profile"];
    return $profile_response;
}

// getting ads
function get_ads ($mysqli){
    $ads_response = [];
    $ads_sql = "SELECT title, image FROM ads";
    $select = $mysqli->prepare($ads_sql);
    $select->execute();
    $array = $select->get_result();
    while ($a = $array->fetch_assoc()){
        $ads_response[] = $a;
    }
    return $ads_response;
}

// getting available categories
function categories($mysqli){
    $categories_response = [];
    $categories_sql = "SELECT * FROM categories";
    $select = $mysqli->prepare($categories_sql);
    $select->execute();
    $array = $select->get_result();
    while($a = $array->fetch_assoc()){
        $categories_response[] = $a;
    }
    return $categories_response;
}

// getting products
function products($mysqli){
    $final_response = [];
    $products_response = [];
    // product info
    $products_sql = "SELECT products.id, product_name, about, price, users.name, users.email
                    FROM `products`
                    INNER JOIN users ON products.seller_id = users.id";
    $select_product = $mysqli->prepare($products_sql);
    $select_product->execute();
    $profile_array = $select_product->get_result();
    while($a = $profile_array->fetch_assoc()){

        $products_response["id"]=$a["id"];
        $products_response["product_name"]=$a["product_name"];
        $products_response["about"]=$a["about"];
        $products_response["price"]=$a["price"];
        $products_response["name"]=$a["name"];
        $products_response["email"]=$a["email"];

        // product images
        $images_sql = "SELECT id , image
                        FROM `images`
                        WHERE product_id = ?";
        $select_images = $mysqli->prepare($images_sql);
        $select_images->bind_param("s", $a["id"]);
        $select_images->execute();
        $images_array = $select_images->get_result();
        $images_response = [];
        while ($b = $images_array->fetch_assoc()){
            $images_response[] = $b;
        }
        $products_response["images"] = $images_response;
        $final_response[] = $products_response;
    }
    return $final_response;
}

// getting favorite products
function favorite_products($mysqli, $id){
    $final_response = [];
    $products_response = [];
    // product info
    $products_sql = "SELECT products.id, product_name, about, price, users.name, users.email
                    FROM `products`
                    INNER JOIN users ON products.seller_id = users.id
                    INNER JOIN favorite ON products.id = favorite.product_id
                    WHERE favorite.client_id = ?";
    $select_product = $mysqli->prepare($products_sql);
    $select_product->bind_param("s", $id);
    $select_product->execute();
    $profile_array = $select_product->get_result();
    while($a = $profile_array->fetch_assoc()){

        $products_response["id"]=$a["id"];
        $products_response["product_name"]=$a["product_name"];
        $products_response["about"]=$a["about"];
        $products_response["price"]=$a["price"];
        $products_response["name"]=$a["name"];
        $products_response["email"]=$a["email"];

        // product images
        $images_sql = "SELECT id , image
                        FROM `images`
                        WHERE product_id = ?";
        $select_images = $mysqli->prepare($images_sql);
        $select_images->bind_param("s", $a["id"]);
        $select_images->execute();
        $images_array = $select_images->get_result();
        $images_response = [];
        while ($b = $images_array->fetch_assoc()){
            $images_response[] = $b;
        }
        $products_response["images"] = $images_response;
        $final_response[] = $products_response;
    }
    return $final_response;
}

echo json_encode(favorite_products($mysqli, $client_id), JSON_UNESCAPED_SLASHES);


?>