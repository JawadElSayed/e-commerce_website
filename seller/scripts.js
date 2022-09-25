console.log("hello");
localStorage.setItem("id","2");



window.onload = () => {
    
  let  data=callAxios(localStorage.getItem("id" ));
  

  }


    
  let callAxios=(seller_id)=> {
    let params = new URLSearchParams();
    params.append("id", seller_id);
    const url = "http://localhost/e-commerce_website/apis/spaseller.php";
    axios({
      method: "post",
      url: url,
      data: params,
    }).then((object) => {
      localStorage.setItem("site_info", JSON.stringify(object.data));
    });
    data = JSON.parse(localStorage.getItem("site_info"));
    return data;
  }