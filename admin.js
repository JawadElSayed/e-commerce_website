window.onload = () =>{

const data = callAxios(seller_id);
profile(data);
// clients(data);

console.log(data);


}


// get elements
localStorage.setItem("id", 58);
const seller_id = localStorage.getItem("id");
const profile_img = document.getElementById("profile_img");
const profile_name = document.getElementById("profile_name");


const profile= (data) => {
    profile_img.src = data["profile"]["image"];
    profile_name.innerHTML = data["profile"]["name"];
}




let callAxios = (id) => {
  let params = new URLSearchParams();
  params.append("id", id);
  const url = "http://localhost/e-commerce_website/apis/spaadmin.php";
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