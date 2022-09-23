// Needed initializations

// Get the Sign-up Modal
///////////////////////////////////////////////////////////////////
var signup_modal = document.querySelector("#myModal-signup");

// Get the button that opens the modal
var signup_btn = document.querySelector("#outer-signup");

// Get the <span> element that closes the modal
var signup_close = document.querySelector("#signup-close");

// When the user clicks the button, open the modal
signup_btn.onclick = function () {
  signup_modal.style.display = "block";
};

// When the user clicks on <span> (x), close the modal
signup_close.onclick = function () {
  signup_modal.style.display = "none";
};

////////////////////////////////////////////////////////////////////

// Get the Sign-up Modal
///////////////////////////////////////////////////////////////////
const signin_modal = document.querySelector("#myModal-signin");

// Get the button that opens the modal
const signin_btn = document.querySelector("#outer-login");

// Get the <span> element that closes the modal
const signin_close = document.querySelector("#signin-close");

// When the user clicks the button, open the modal
signin_btn.onclick = function () {
  signin_modal.style.display = "block";
};

// When the user clicks on <span> (x), close the modal
signin_close.onclick = function () {
  signin_modal.style.display = "none";
};

////////////////////////////////////////////////////////////////////

// Get the password Modal
/////////////////////////////////////////////////////////////////
const pass_modal = document.querySelector("#myModal-password");

// Get the button that opens the modal
const change_pass = document.querySelector("#forgot-pass");

// Get the <span> element that closes the modal
const pass_close = document.querySelector("#pass-close");

// When the user clicks the button, open the modal
change_pass.onclick = function () {
  pass_modal.style.display = "block";
};

// When the user clicks on <span> (x), close the modal
pass_close.onclick = function () {
  pass_modal.style.display = "none";
};

////////////////////////////////////////////////////////////////////

// When the user clicks anywhere outside of any modal, close it
window.onclick = function (event) {
  if (event.target == signin_modal) {
    signin_modal.style.display = "none";
  }
  if (event.target == signup_modal) {
    signup_modal.style.display = "none";
  }
  if (event.target == pass_modal) {
    pass_modal.style.display = "none";
  }
};
////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////

//  Copied this from my previous twitter project
// sign up getting data from server
php_signup = "http://localhost/Backend/E-commerce-BurnStore/sign_up.php";
label = document.createElement("label");
const sign_up_btn = document.querySelector("#sign-up-btn");
const signup_name = document.querySelector("#p2-name");

const signup_username = document.querySelector("#p2-username");
const signup_password = document.querySelector("#p2-password");
const email = document.querySelector("#p2-email");
sign_up_btn.addEventListener("click", () => {
  let singup_params = new URLSearchParams();
  singup_params.append("name", signup_name.value);
  singup_params.append("email", email.value);
  singup_params.append("username", signup_username.value);
  singup_params.append("user_type", 3);
  singup_params.append("password", signup_password.value);
  axios({
    method: "post",
    url: php_signup,
    data: singup_params,
  }).then((object) => {
    if (object.data.status == "used username") {
      signup_username.insertAdjacentElement("afterEnd", label);
      label.textContent = "Username exists";
    } else if (object.data.status == "used email") {
      email.insertAdjacentElement("afterEnd", label);
      label.textContent = "Email already used";
    } else {
      signup_modal.style.display = "none";
      signin_modal.style.display = "block";
    }
  });
});

// This is the logIn section, checking if the data is in the server
php_signin = "some link";
const logIn = document.querySelector("#log-in");
const user = document.querySelector("#p2-username");
const password = document.querySelector("#p2-password");

logIn.addEventListener("click", function () {
  let signin_params = new URLSearchParams();
  signin_params.append("username", user.value);
  signin_params.append("password", password.value);
  axios({
    method: "post",
    url: php_signin,
    data: signin_params,
  }).then((object) => {
    if (object.data.status == "wrong username") {
      user.insertAdjacentElement("afterEnd", label);
      label.textContent = "Username doesn't exist";
    } else if (object.data.status == "wrong password") {
      password.insertAdjacentElement("afterEnd", label);
      label.textContent = "Password is invalid";
    } else if (object.data.status == "banned") {
      user.insertAdjacentElement("afterEnd", label);
      label.textContent = "You are banned! Get Out of here NIGGA";
    } else {
      localStorage.setItem("id", object.data.user_id);
      console.log(localStorage.getItem("id"));
    }
  });
});

// Changing passwords actually
const Send_email = document.querySelector("#Send_email");
const Validate_code = document.querySelector("Validate-code");
const Change_pass_btn = document.querySelector("change-pass-btn");
