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
    $array=array();
    $counter=0;
    while ($a = $array_get_conversations->fetch_assoc()){
        $first = $a['sender'];
        $second = $a['receiver'];
        $product=$a['product_id'];
        if($counter==0){
            $new="";
            if($id==$first){
                $new=$new.$second;
                echo $new;
            }else{
                $new=$new.$first;
                echo $new;
            }
            $new=$new.$product;
            echo $new;
        }
        $counter++;
        echo '<br>';
    }    
    echo $new;
    // echo json_encode($array);

// }
?>