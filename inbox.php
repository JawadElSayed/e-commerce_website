<?php

include("connection.php");

// if(isset($_POST['id'])){
//     $id=$_POST['id'];
    $id=2;
    $get_conversations=$mysqli->prepare("SELECT id,chat.sender,chat.receiver,chat.product_id
    FROM chat 
    WHERE chat.sender=? OR chat.receiver=?
    ORDER BY chat.sender,chat.product_id");
    $get_conversations->bind_param("ss",$id,$id);
    $get_conversations->execute();
    $array_get_conversations=$get_conversations->get_result();

    while ($a = $array_get_conversations->fetch_assoc()){
        
    }    
    echo $new;
    // echo json_encode($array);

// }
?>