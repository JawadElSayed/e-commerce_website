const home = document.querySelector("#Home-txt");
const favoriteS = document.querySelector("#Favorites-txt");
const wishlist = document.querySelector("#Wishlist-txt");
const inbox = document.querySelector("#Inbox-txt");
const cart = document.querySelector("#cart-im");
Home();
home.addEventListener("click", Home);
favoriteS.addEventListener("click", Favorites);
wishlist.addEventListener("click", Wishlist);
inbox.addEventListener("click", Inbox);
cart.addEventListener("click", Cart);

let singup_params = new URLSearchParams();
//   singup_params.append("name", signup_name.value);

axios({
  method: "post",
  url: php_signup,
  data: singup_params,
}).then((object) => {});

// sign_up_btn.addEventListener("click", () => {
//     let singup_params = new URLSearchParams();
//     singup_params.append("name", signup_name.value);
//     singup_params.append("email", email.value);
//     singup_params.append("username", signup_username.value);
//     singup_params.append("user_type", 3);
//     singup_params.append("password", signup_password.value);

//     axios({
//       method: "post",
//       url: php_signup,
//       data: singup_params,
//     }).then((object) => {
//       if (object.data.status == "used username") {
//         signup_username.insertAdjacentElement("afterEnd", label);
//         label.textContent = "Username exists";
//       } else if (object.data.status == "used email") {
//         email.insertAdjacentElement("afterEnd", label);
//         label.textContent = "Email already used";
//       } else {
//         signup_modal.style.display = "none";
//         signin_modal.style.display = "block";
//       }
//     });
//   });

function Home() {
  ad_list = "";
  dot_list = "";
  const DOTS = document.querySelector(".align-dots");
  const ADS = document.querySelector(".ads");
  brk = `<br />`;
  for (let i = 0; i < 3; i++) {
    ad_img_url = "/Assets/Clients/Client-1.jpg";

    ad = `<div class="mySlides fade">
    <img
      src="${ad_img_url}"
      class="ad-image"
    />
    </div>`;
    ad_list += ad;

    dot_list += `<span class="dot"></span>`;
  }
  total = ad_list + brk + dot_list;
  DOTS.innerHTML += total;

  // Animation of the ads
  let slideIndex = 0;
  showSlides();

  function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
      slideIndex = 1;
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    setTimeout(showSlides, 4000); // Change image every 3 seconds
  }

  product = `<div class="products-header">
  <h1>Products</h1>
</div>
<div class="products">
  <div class="product grow">
    <div class="prod-ims">
      <img class="prod-img" src="${prod_img}" />
      <img class="prod-heart" src="/Assets/icons/emptyHeart.svg" />
    </div>
    <p id="prod-name">${prod_name}</p>
    <p id="prod-price">${prod_price}</p>
  </div>
</div>`;
}

function Favorites() {}
function Wishlist() {}
function Inbox() {}
function Cart() {}
