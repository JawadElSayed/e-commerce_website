window.onload = () => {
  const home = document.querySelector("#Home-txt");
  const favoriteS = document.querySelector("#Favorites-txt");
  const wishlist = document.querySelector("#Wishlist-txt");
  const inbox = document.querySelector("#Inbox-txt");
  const cart = document.querySelector("#cart-im");
  const client_ID = localStorage.getItem("id")
    ? JSON.parse(localStorage.getItem("id"))
    : "";
  home.addEventListener("click", function () {
    Home(callAxios(client_ID), client_ID);
  });
  favoriteS.addEventListener("click", Favorites);
  wishlist.addEventListener("click", Wishlist);
  inbox.addEventListener("click", Inbox);
  cart.addEventListener("click", Cart);
  Home(callAxios(client_ID), client_ID);
};

function Home(data, client_ID) {
  console.log(data);
  ad_list = "";
  dot_list = "";
  const DOTS = document.querySelector(".align-dots");
  const ADS = document.querySelector(".ads");
  brk = `<br />`;

  for (let i = 0; i < data.ads.length; i++) {
    ad_img_url = data.ads[i].image;
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

  let prod_list = "";
  const prod_s = document.querySelector(".products-content");
  prod_header = `<div class="products-header">
  <h1>Products</h1>
  </div>`;
  for (let i = 0; i < data.products.length; i++) {
    prod_img = data.products[i].images[0].image;
    prod_name = data.products[i].product_name;
    prod_price = data.products[i].price;
    product = `
    <div id="${data.products[i].id}" class="product grow">
      <div class="prod-ims">
        <img class="prod-img" src="${prod_img}" />
        <img class="prod-heart" src="/Assets/icons/emptyHeart.svg" />
      </div >
      <div class="prod-init-description">
      <p id="prod-name">${prod_name}</p>
      <p id="prod-price">${prod_price}$</p>
      </div>
    </div>
  `;
    prod_list += product;
  }

  total = prod_header + `<div class="products">` + prod_list + `</div`;
  prod_s.innerHTML += total;

  // Get the product Modal
  ///////////////////////////////////////////////////////////////////
  const product_modal = document.querySelector("#myModal-product");

  // Get the button that opens the modal
  const product_elements = Array.from(
    document.getElementsByClassName("product")
  );
  // Get the <span> element that closes the modal
  const product_close = document.querySelector("#product-close");

  // the left part of the modal
  const left = document.querySelector(".left");
  // The right part of the modal
  const right = document.querySelector(".right");

  // When the user clicks the button, open the modal and the content is generated depending on the product
  product_elements.forEach((element) => {
    element.onclick = function () {
      clicked_product = findElement(element.id);
      left_content = `<p>${clicked_product.product_name}</p>
      <img src="${clicked_product.images[0].image}" />`;
      left.innerHTML = "";
      left.innerHTML += left_content;
      right_content = `<div class="right-about">
      <h2>About</h2>
      <hr />
      <p>
        ${clicked_product.about}
      </p>
    </div>
    <div class="right-seller">
      <h2>Seller</h2>
      <hr />
      <div class="seller-part">
        <div class="seller-right">
          <p>${clicked_product.name}</p>
          <p>${clicked_product.email}</p>
        </div>
        <div class="seller-left">
          <button>Message</button>
        </div>
      </div>
    </div>
    <hr />
    <div class="right-actions">
      <div class="first-line">
        <p>${clicked_product.price}$</p>
        <div class="wishlist-sec">
          <p>Add to wishlist</p>
          <img src="/Assets/icons/wishlist.svg" />
        </div>
      </div>
      <div class="second-line">
        <p>Quantity:</p>
        <div class="counter">
          <img src="/Assets/icons/minus_btn.svg" />
          <p>5</p>
          <img src="/Assets/icons/plus_btn.svg" />
        </div>
        <div class="like-container">
          <img src="/Assets/icons/emptyHeart.svg" />
        </div>
      </div>
      <div class="third-line">
        <button class="add-to-cart-btn">Add to Cart</button>
      </div>
    </div>`;
      right.innerHTML = "";
      right.innerHTML += right_content;
      product_modal.style.display = "block";
    };
  });

  // When the user clicks on <span> (x), close the modal
  product_close.onclick = function () {
    product_modal.style.display = "none";
  };

  ////////////////////////////////////////////////////////////////////
}

function Favorites(data,client_ID) {}
function Wishlist(data,client_ID) {}
function Inbox() {}
function Cart() {}

let callAxios = (client_ID) => {
  let params = new URLSearchParams();
  params.append("client_id", client_ID);
  const url = "http://localhost/Backend/E_commerce_BurnStore/client_spa.php";
  axios({
    method: "post",
    url: url,
    data: params,
  }).then((object) => {
    localStorage.setItem("site_info", JSON.stringify(object.data));
  });
  data = JSON.parse(localStorage.getItem("site_info"));
  return data;
};

function findElement(id) {
  for (const x of data.products) {
    if (id == x.id) {
      return x;
    }
  }
  return null;
}
