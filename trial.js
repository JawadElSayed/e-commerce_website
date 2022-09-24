ad_list = "";
dot_list = "";
for(let i=0;i<3;<i++)
{
ad_img_url=i

  ad = `<div class="mySlides fade">
<img
  src="${ad_img_url}"
  class="ad-image"
/>
</div>`
 ad_list+=ad;
 
  dot_list += `<span class="dot"></span>`
}


  brk = `<br />`;
