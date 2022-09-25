<?php

include("connection.php");

if(isset($_POST['email'])){
    $email=$_POST['email'];
    $code=$_POST['code'];
    // Get the id of this email
    $get_id_from_email=$mysqli->prepare("SELECT id from users WHERE email=? LIMIT 1");
    $get_id_from_email->bind_param("s",$email);
    $response=[];
    $get_id_from_email->execute();
    $return_get_id_from_email=$get_id_from_email->get_result();
    $row_get_id_from_email= mysqli_num_rows($return_get_id_from_email);
    $return_get_id_from_email=$return_get_id_from_email->fetch_assoc();
    // If number of rows of the return of above query is zero, so this email is not existed, otherwise, it's existed
    if($row_get_id_from_email!=0){
        $id=$return_get_id_from_email['id'];
        // The below query will get the number of codes sent to the client
        $exist_code=$mysqli->prepare("SELECT COUNT(*) as count FROM reset_password WHERE client_id=?");
        $exist_code->bind_param("s",$id);
        $exist_code->execute();
        $return_exist_code=$exist_code->get_result()->fetch_assoc();
        // If number of rows of the return of above query is zero, so the code has not been sent yet to the client,
        // so, we have to generate code and send it to the client.
        if($return_exist_code['count']==0){
            // generat code
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $code = substr( str_shuffle( $chars ), 0, 4 );
            // $code = hash("sha256", $code);
            date_default_timezone_set('Asia/Beirut');
            $current_time = date ("Y-m-d H:m:s");
            // Enter the code generated to the user
            $insert_code=$mysqli->prepare("INSERT INTO reset_password(code,created_at,client_id) VALUES(?,?,?)");
            $insert_code->bind_param("sss",$code,$current_time,$id);
            $response=[];
            if($insert_code->execute()){
                $to=$email;
                $subject="Reset Password";
                $message="Your code is: ".$code;
                // Here we are suposing that the code has been sent, and we have tried to change some 
                // lines in php.ini and sendmain.ini but, the whole xampp has been breakdown
                // mail($to,$subject,$message);
                $response['status']='code sent';
            }else{
                $response['status']='error';
            }
        }else{
            if($code==""){
                $response['status']="code sent before";
            }else{
                // $code = hash("sha256", $code);
                // Now we are comparing the code sent by client to the one existed into table reset_password
                $check_code=$mysqli->prepare("SELECT COUNT(*) as checking FROM reset_password WHERE client_id=? AND code=? LIMIT 1");
                $check_code->bind_param("ss",$id,$code);
                $check_code->execute();
                $return_check_code=$check_code->get_result()->fetch_assoc();
                if($return_check_code['checking']==0){
                    $response['status']="Wrong password";
                }else{

                    // If it's the same, so we have to delete this row from reset_password table.
                    // That means, this page is for send the email and comparing it at the same time.
                    $delete_code=$mysqli->prepare("DELETE FROM reset_password WHERE client_id=?");
                    $delete_code->bind_param("s",$id);
                    if($delete_code->execute()){
                        $response['status']="change passowrd";
                    }else{
                        $response['status']='error';
                    }
                }
            }
        }
    }else{
        $response['status']="email not existed";
    }   
    echo json_encode($response);


    
}
?>