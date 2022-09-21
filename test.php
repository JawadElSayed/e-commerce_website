

<!-- array = ["hi","hello","deal"];
array1=JSON.stringify(array);

//send     
    let url = `http://localhost/e-commerce_website/test.php?arr=${array1}`;
    fetch(url)
    .then(respone=>respone.json())
    .then(data=>{
      for(let i=0;i<Object.values(data)[0].length;i++){
        console.log(Object.values(data)[0][i]);
      }
        
    }); -->


//<?php
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
// header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
// include("connection.php");

// // $array=json_decode($_GET['arr']);
// $array=["hi","hello","deal","1"];
// $res=[];
// foreach($array as $arr1){
//     $res[]=$arr1;
// }
// $response=[];
// $response['return']=$res;
// echo json_encode($response);

?>
