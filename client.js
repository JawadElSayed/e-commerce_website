window.onload = () => {
  const home = document.querySelector("#Home-txt");
  const favoriteS = document.querySelector("#Favorites-txt");
  const wishlist = document.querySelector("#Wishlist-txt");
  const inbox = document.querySelector("#Inbox-txt");
  const cart = document.querySelector("#cart-im");
  const client_ID = localStorage.getItem("id")
    ? JSON.parse(localStorage.getItem("id"))
    : "";

  callAxios(client_ID);
  Home();
};

// home.addEventListener("click", Home);
// favoriteS.addEventListener("click", Favorites);
// wishlist.addEventListener("click", Wishlist);
// inbox.addEventListener("click", Inbox);
// cart.addEventListener("click", Cart);

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

  //   product = `<div class="products-header">
  //   <h1>Products</h1>
  // </div>
  // <div class="products">
  //   <div class="product grow">
  //     <div class="prod-ims">
  //       <img class="prod-img" src="${prod_img}" />
  //       <img class="prod-heart" src="/Assets/icons/emptyHeart.svg" />
  //     </div>
  //     <p id="prod-name">${prod_name}</p>
  //     <p id="prod-price">${prod_price}</p>
  //   </div>
  // </div>`;
}

function Favorites() {}
function Wishlist() {}
function Inbox() {}
function Cart() {}

function callAxios(client_ID) {
  let params = new URLSearchParams();
  params.append("client_id", client_ID);
  const allapi = "http://localhost/Backend/E_commerce_BurnStore/client_spa.php";
  axios({
    method: "post",
    url: allapi,
    data: params,
  }).then((object) => {
    console.log(object.data);
  });
}
