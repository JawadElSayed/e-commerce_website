
// get elements
localStorage.setItem("id", 58)
const seller_id = localStorage.getItem("id");
const profile_img = document.getElementById("profile_img");
const profile_name = document.getElementById("profile_name");
const page_title = document.getElementById("page_title");
const titles = document.getElementById("titles");
const row_container = document.getElementById("row_container");
const clients_btn = document.getElementById("clients_btn");
const sellers_btn = document.getElementById("sellers_btn");
const statistics_btn = document.getElementById("statistics_btn");
const result_name = document.querySelectorAll(".result_name");

// get profile
const profile= (data) => {
    profile_img.src = `../${data["profile"]["image"]}`;
    profile_name.innerHTML = data["profile"]["name"];
}

// header table
const titles_row = (page) => {
    row = `<div class = "title_name_${page}">
                <h2>Picture</h2>
                <h2>Name</h2>
                <h2>email</h2>
                <h2>username</h2>
                <h2>Actions</h2>
            </div>
            <div>
                <hr class="row-break">
            </div>`;
    titles.innerHTML = row;
}

// get clients
const clients = (data) => {
    titles_row("clients");
    page_title.innerHTML = "Clients"
    let rows = "";
    for(let i of data["clients"]){
        let id = i["id"];
        let profile = i["profile"];
        let name = i["name"];
        let email = i["email"];
        let username = i["username"];
        let row = `<div id = "${id}" class="row">
                        <img src="../${profile}" class="profile_img">
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
  let data = JSON.parse(localStorage.getItem("site_info"));
  return data;
}

// get sellers
const sellers = (data) => {
    page_title.innerHTML = "Sellers"
    titles_row("sellers");
    let rows = "";
    for(let i of data["sellers"]){
        let id = i["id"];
        let profile = i["profile"];
        let name = i["name"];
        let email = i["email"];
        let username = i["username"];
        let row = `<div id = "${id}" class="row">
                        <img src="../${profile}" class="profile_img">
                        <p>${name}</p>
                        <p>${email}</p>
                        <p>${username}</p>
                        <div>
                            <button class="ban_button">Edit</button>
                            <button class="ban_button">Delete</button>
                        </div>    
                    </div>
                    <hr class="row-break">`;
        rows += row;
    }
    row_container.innerHTML = rows;
}

// statistics
const stat = (data) => {
    let all_cards = document.getElementById("all_cards")
    page_title.innerHTML = "Statistics"
    let card = `<div class="stat_card">
                    <h3>Best seller of the week</h3>
                    <h3 class="result_name">name</h3>
                </div>`
    // best seller
    let rows = `<div class="card_row">`;
    for(let i in data["best_seller"]){        
        card = `<div class="stat_card">
                    <h3>Best seller of the ${i}</h3>
                    <h3 class="result_name">${data["best_seller"][i]}</h3>
                </div>`
        rows += card
    }
    rows += `</div>`
    all_cards.innerHTML += rows;
    // best client
    rows = `<div class="card_row">`;
    for(let i in data["best_client"]){
    card = `<div class="stat_card">
                <h3>Best seller of the ${i}</h3>
                <h3 class="result_name">${data["best_client"][i]}</h3>
            </div>`
    rows += card
    }
    rows += `</div>`
    all_cards.innerHTML += rows;
    // best numbers
    rows = `<div class="card_row">`;
    for(let i in data["numbers"]){
        card = `<div class="stat_card">
                    <h3>Best seller of the ${i}</h3>
                    <h3 class="result_name">${data["numbers"][i]}</h3>
                </div>`
        rows += card
        }
        rows += `</div>`
        all_cards.innerHTML += rows;
}


const data = callAxios(seller_id);
console.log(data);
profile(data);
clients(data);

clients_btn.addEventListener("click", function(){
    clients(data);
});

sellers_btn.addEventListener("click", function(){
    sellers(data);
});

statistics_btn.addEventListener("click", function(){
    stat(data);
});