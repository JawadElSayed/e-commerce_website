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
