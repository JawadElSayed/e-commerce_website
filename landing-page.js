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

// Go from sign up to sign in
const btn_signup_modal = document.querySelector("#sign-up-btn");
btn_signup_modal.addEventListener("click", () => {
  signin_modal.style.display = "block";
  signup_modal.style.display = "none";
});

// Forget password Modal
const forget_pass = document.querySelector("#forget-pass");
forget_pass.addEventListener("click", () => {
  signin_modal.style.display = "block";
  signup_modal.style.display = "none";
});

///////////////////////////////////////////////////////////////////////////////

// axios POST request

axios(options).then((response) => {
  console.log(response.status);
});

//  Copied this from my previous twitter project
// sign up getting data from server
php_signup = "some link";
const sign_up_btn = document.querySelector("#sign-up-btn");
sign_up_btn.addEventListener("click", () => {
  const options = {
    url: "http://localhost:3000/api/home",
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json;charset=UTF-8",
    },
    // data: {
    //   name:
    //   email:"";
    //   username:"";
    //   user_type:
    // },
  };
  axios(options)
    .then((x) => x.json())
    .then((y) => {
      if (!y.ispresent) {
        fetch(php_signup, {
          method: "POST",
          body: new URLSearchParams({
            full_name: signup_name.value,
            user_name: signup_username.value,
            email: email.value,
            dob: dob.value,
            user_password: signup_password.value,
          }),
        });
        signup_modal.style.display = "none";
        signinmodal.style.display = "block";
      } else {
        const signup_username_label = signup_username.insertAdjacentElement(
          "afterend",
          label
        );
        signup_username_label.textContent = "Username exists";
      }
    });
});

// This is the logIn section, checking if the data is in the server

const logIn = document.querySelector("#log-in");
const user = document.querySelector("#p2-username");
const password = document.querySelector("#p2-password");

logIn.addEventListener("click", function () {
  fetch(php_login, {
    method: "POST",
    body: new URLSearchParams({
      user_name: user.value,
      user_password: password.value,
    }),
  })
    .then((x) => x.json())
    .then((y) => {
      if (!y.ispresent) {
        username_label = user.insertAdjacentElement("afterend", label);
        username_label.textContent = "Username doesn't exist";
      } else {
        password_label = password.insertAdjacentElement("afterend", label);
        if (!y.pass_valid) {
          password_label.textContent = "Password is invalid";
        } else {
          window.location.href = "/Frontend/home-page/homepage.html";
          password_label.textContent = "WELCOME";
          localStorage.setItem("active-user", JSON.stringify(user.value));
        }
      }
    });
});

// Changing passwords actually
const Send_email = document.querySelector("#Send_email");
const Validate_code = document.querySelector("Validate-code");
const Change_pass_btn = document.querySelector("change-pass-btn");
