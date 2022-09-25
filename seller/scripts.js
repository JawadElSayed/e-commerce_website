const profile_image=document.getElementById("profile_image");
const seller_name=document.getElementById("seller_name");
const card_container=document.getElementById("card_container");
const whole_content=document.getElementById("whole_content");
// Elemets of view more popup
const view_more_popup=document.getElementById("view_more_popup");
const view_more_close=document.getElementById("view_more_close");
const view_more_image=document.getElementById("view_more_image");
const view_more_about=document.getElementById("view_more_about");
const view_more_price=document.getElementById("view_more_price");
const view_more_pcategory_name= document.getElementById("view_more_pcategory_name");
// Elements of delete product
const delete_product_popup=document.getElementById("delete_product_popup");
const delete_product_btn_yes=document.getElementById("delete_product_btn_yes");
const delete_product_btn_no=document.getElementById("delete_product_btn_no");
// Elements of edit products
const edit_product_close = document.getElementById("edit_product_close");
const edit_product_popup=document.getElementById("edit_product_popup");
const edit_product_popup_name=document.getElementById("edit_product_popup_name");
const edit_product_popup_price=document.getElementById("edit_product_popup_price");
const edit_product_popup_about=document.getElementById("edit_product_popup_about");
const edit_product_popup_upload=document.getElementById("edit_product_popup_upload");

window.onload = () => {
  localStorage.setItem("id","3");
  let data=callAxios(localStorage.getItem("id"));
  profile_image.src=`../${data.profile.image}`;
  seller_name.innerText=data.profile.name;
  let array_products=data.products;
    header=`<div class="row">
    <div><p>Picture</p></div>
    <div><p>Name</p></div>
    <div><p>Price</p></div>
    <div><p>Category</p></div>
    <div><p>Actions</p></div>
</div>
<hr class="row-break">`;
product_list='';
    let counter=0;
    let counter1=0;
    let counter2=0;
    for(i of array_products){
      console.log("dsds");
      let all_first_images=i.images[0];
      let first_image=all_first_images.image;
      div = `<div class="row-product">
      <div><img src=../${first_image}  id="${counter}" class="img-view-more"></div>
      <div><p>${i.product_name}</p></div>
      <div ><p>${i.price}</p></div>
      <div><p>${i.category_name}</p></div>
      <div>
          <button id="${counter1}"  class="edit-product row-product-btn">Edit</button>
          <button id="${counter2}" class="delete-product row-product-btn">Delete</button>
          </div>
      </div>
      <hr class="row-break">
      `;
    
      product_list+=div;
      counter++;
      counter1++;
      counter2++;
    }
    total=header+product_list
    card_container.innerHTML=total;
  
    
    const view_more_popup_contents = Array.from(document.getElementsByClassName("img-view-more"));
    view_more_popup_contents.forEach(element => {
      element.addEventListener("click",function(){
          let clicked_picture=findElement(element.id,view_more_popup_contents);
          console.log(element.id);
          clicked_picture.addEventListener("click",function(){
            whole_content.style.display="flex";
            view_more_popup.style.display="flex";
            view_more_image.src= `../${array_products[clicked_picture.id].images[0].image}`;
            view_more_about.innerText = `${array_products[clicked_picture.id].about}`;
            view_more_price.innerText = `price :${array_products[clicked_picture.id].price}`;
            view_more_pcategory_name.innerText = `category_name :${array_products[clicked_picture.id].category_name}`;
          })
        })  
    });

    const delete_product_popup_contnents = Array.from(document.getElementsByClassName("delete-product"));
    delete_product_popup_contnents.forEach(element => {
      
      element.addEventListener("click",function(){
          let clicked_button=findElement(element.id,delete_product_popup_contnents);
          clicked_button.addEventListener("click",function(){
            whole_content.style.display="flex";
            delete_product_popup.style.display="flex";
            delete_product_btn_yes.addEventListener("click",function(){
              
              let params = new URLSearchParams();
              params.append("id", array_products[element.id].id);
              const url = "http://localhost/e-commerce_website/apis/deleteproduct.php";
              axios({
                method: "post",
                url: url,
                data: params,
              }).then((object) => {
                whole_content.style.display="none";
                delete_product_popup.style.display="none";
                location.reload();
              });
            })

          })
        })  
    });
    


    const edit_product_popup_contents = Array.from(document.getElementsByClassName("edit-product"));
    edit_product_popup_contents.forEach(element => {
      element.addEventListener("click",function(){
        console.log(array_products[element.id].product_name);
          let clicked_button=findElement(element.id,edit_product_popup_contents);
          clicked_button.addEventListener("click",function(){
            whole_content.style.display="flex";
            edit_product_popup.style.display="flex";
            edit_product_popup_name.value = array_products[element.id].product_name;
            edit_product_popup_about.value = array_products[element.id].about;
            edit_product_popup_price.value=array_products[element.id].price;
          })
        })  
    });



    view_more_close.addEventListener("click",function(){
       whole_content.style.display="none";
       view_more_popup.style.display="none";
    })


    delete_product_btn_no.addEventListener("click",function(){
      whole_content.style.display="none";
      delete_product_popup.style.display="none";
  })
  edit_product_close.addEventListener("click",function(){
    whole_content.style.display="none";
    edit_product_popup.style.display="none";
  })

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
  let findElement=(id,view_more_popup_contents) =>{
    for (const x of view_more_popup_contents) {
      if (id == x.id) {
        return x;
      }
    }
    return null;
  }