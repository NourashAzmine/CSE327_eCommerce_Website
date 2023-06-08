
let userBox = document.querySelector('.header .header-2 .user-box');

document.querySelector('#user-btn').onclick = () =>{
   userBox.classList.toggle('active');
   navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .header-2 .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   userBox.classList.remove('active');
}

window.onscroll = () =>{
   userBox.classList.remove('active');
   navbar.classList.remove('active');

   if(window.scrollY > 60){
      document.querySelector('.header .header-2').classList.add('active');
   }else{
      document.querySelector('.header .header-2').classList.remove('active');
   }
}

function enableEdit(fieldId) {
   var fieldText = document.getElementById(fieldId + '-text');
   var fieldInput = document.getElementById(fieldId + '-input');
   var editBtn = document.getElementById(fieldId + '-edit');

   fieldText.style.display = 'none';
   fieldInput.style.display = 'inline-block';
   editBtn.style.display = 'none';
}

function showPasswordFields() {
   document.getElementById('password-fields').style.display = 'block';
}

function togglePasswordVisibility(fieldId) {
   var passwordField = document.getElementById(fieldId);
   var toggleBtn = passwordField.nextElementSibling;

   if (passwordField.type === "password") {
      passwordField.type = "text";
      toggleBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
   } else {
      passwordField.type = "password";
      toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
   }
}

// out of stock
var buttons = document.querySelectorAll(".delete-btn.out-of-stock");

buttons.forEach(function(button) {
  button.addEventListener("mouseover", function() {
    button.innerText = "Request Product";
    button.classList.add("request-product");
  });

  button.addEventListener("mouseout", function() {
    button.innerText = "Out of Stock";
    button.classList.remove("request-product");
  });
});
