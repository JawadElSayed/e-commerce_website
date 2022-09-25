window.onload = () =>{

const data = callAxios(seller_id);
profile(data);
clients(data);

console.log(data);


}


// get elements
localStorage.setItem("id", 58);
const seller_id = localStorage.getItem("id");
const profile_img = document.getElementById("profile_img");
const profile_name = document.getElementById("profile_name");
const titles = document.querySelector(".titles");
const row_container = document.getElementById("row_container");

// get profile
const profile= (data) => {
    profile_img.src = data["profile"]["image"];
    profile_name.innerHTML = data["profile"]["name"];
}

// header table
const titles_row = () => {
    row = `<h2>Picture</h2>
                <h2>Name</h2>
                <h2>email</h2>
                <h2>username</h2>
                <h2>Actions</h2>`;
    titles.innerHTML = row;
}

// get clients
const clients = (data) => {
    titles_row();
    let rows = "";
    for(let i of data["clients"]){
        let profile = i["profile"];
        let name = i["name"];
        let email = i["email"];
        let username = i["username"];
        let row = `<div class="row">
                        <img src="${profile}" class="profile_img">
                        <p>${name}</p>
                        <p>${email}</p>
                        <p>${username}</p>
                        <button class="ban_button">Ban</button>
                    </div>
                    <hr class="row-break">`;
        rows += row;
    }
    row_container.innerHTML = rows;
}

// call data
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