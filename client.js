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

function Home() {
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
    setTimeout(showSlides, 3000); // Change image every 3 seconds
  }

  //Adding ad images
  ad_list = "";
  ad = `<div class="mySlides fade">
<img
  src="${ad_img_url}"
  class="ad-image"
/>
</div>`;
  brk = `<br />`;
  dot_list = "";
  dot = `<span class="dot"></span>`;
}

function Favorites() {}
function Wishlist() {}
function Inbox() {}
function Cart() {}
