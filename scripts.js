array = ["hi","hello","deal"];
array1=JSON.stringify(array);

//send     
    let url = `http://localhost/e-commerce_website/test.php?arr=${array1}`;
    fetch(url)
    .then(respone=>respone.json())
    .then(data=>{
      for(let i=0;i<Object.values(data)[0].length;i++){
        console.log(Object.values(data)[0][i]);
      }
        
    });