<?php 
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

if(isset($_POST['seller_id'])){
    // Get all parameters using POST method
    $seller_id=$_POST['seller_id'];
    $name=$_POST['name'];
    $profile=$_POST['profile'];
    $response=[];
    // If the name has been sent empty by javascript,it  will be never changed, otherwise, it will be 
    // updated as new name for the specified seller.
    if($name!=""){
        // Change name of the specified seller.
        $change_name=$mysqli->prepare("UPDATE `users` SET `name` = ? WHERE `id` = ?");
        $change_name->bind_param("ss",$name,$seller_id);
        // If the above query has been executed, the response of name will be done, otherwise, the response will be error.
        if($change_name->execute()){
            $response['name']="done";
        }else{
            $response['name']="error";
        }
    }
    // If the profile has been sent empty by javascript, it will be never changed, otherwise, it will be 
    // updated as new profile for the specified seller, in addition to delete the old profile.
    if($profile!=""){
        // Get old profile in order to unlink it (delete it).
        $get_old_profile=$mysqli->prepare("SELECT `profile` FROM `users` WHERE `id` = ? LIMIT 1");
        $get_old_profile->bind_param("s",$seller_id);
        $get_old_profile->execute();
        $return_get_old_profile=$get_old_profile->get_result()->fetch_assoc();
        // Delete the old profile from images/profile/
        unlink($return_get_old_profile['profile']);
        $path="images/profile/";
        // Get final path of the profile by saveImage function.
        $final_path=saveImage($profile,$path);
        // Update the new path for the specified seller.
        $update_new_profile=$mysqli->prepare("UPDATE `users` SET profile = ? WHERE id = ?");
        $update_new_profile->bind_param("ss",$final_path,$seller_id);
        // If the above query has been executed, the response of profile will be done, otherwise, the response will be error.
        if($update_new_profile->execute()){
            $response['profile']="done";
        }else{
            $response['profile']="error";
        }
    }
    echo json_encode($response);
}
?>