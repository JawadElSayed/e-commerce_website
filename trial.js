ad_list = "";
dot_list = "";
DOTS = document.querySelector(".align-dots");
ADS = document.querySelector(".ads");
for (let i = 0; i < 3; i++) {
  ad_img_url = i;

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
