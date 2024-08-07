formOpenbtn = document.querySelector("#form-open"),
home = document.querySelector(".home"),
formContainer = document.querySelector(".form-container"),
formCloseBtn = document.querySelector(".form_close"),
signupBtn = document.querySelector("#signup"),
loginBtn = document.querySelector("#login"),
pwShowHide = document.querySelector(".pw_hide");

formOpenbtn.addEventListener("click", () => formContainer.classList.add("show"))
formCloseBtn.addEventListener("click", () => formContainer.classList.remove("show"))

loginBtn.addEventListener("click", (e) =>{
    e.preventDefault();
    formContainer.classList.remove("active");
});
signupBtn.addEventListener("click", (e) =>{
    e.preventDefault();
    formContainer.classList.add("active");
});
    


function scrolll(){
    var left = document.querySelector(".scroll-images");
    left.scrollBy(-518, 0);
}
function scrollr(){
    var right =document.querySelector(".scroll-images");
    right.scrollBy(518, 0);
}
function showw(){
    var showw = document.getElementsByClassName("paragraph-desc");
    
    var element = showw[0];
    if (element.style.display === "none"){
        element.style.display = "flex";
    }else{
        element.style.display = "none"
    }

}
function showw2(){
    var showw = document.getElementsByClassName("paragraph-desc");
    
    var element = showw[1];
    if (element.style.display === "none"){
        element.style.display = "flex";
    }else{
        element.style.display = "none"
    }

}
function showw3(){
    var showw = document.getElementsByClassName("paragraph-desc");
    
    var element = showw[2];
    if (element.style.display === "none"){
        element.style.display = "flex";
    }else{
        element.style.display = "none"
    }

}
function showw4(){
    var showw = document.getElementsByClassName("paragraph-desc");
    
    var element = showw[3];
    if (element.style.display === "none"){
        element.style.display = "flex";
    }else{
        element.style.display = "none"
    }

}
function showw5(){
    var showw = document.getElementsByClassName("paragraph-desc");
    
    var element = showw[4];
    if (element.style.display === "none"){
        element.style.display = "flex";
    }else{
        element.style.display = "none"
    }

}
function showw6(){
    var showw = document.getElementsByClassName("paragraph-desc");
    
    var element = showw[5];
    if (element.style.display === "none"){
        element.style.display = "flex";
    }else{
        element.style.display = "none"
    }

}



// Sign up form
// document.addEventListener("DOMContentLoaded", function() {
//     // Add an event listener to the form submission
//     document.getElementsByClassName("form signup_form").addEventListener("submit", function(event) {
//       event.preventDefault(); // Prevent the default form submission behavior
  
//       // Perform your form validation and registration process here
//       // For demonstration purposes, we'll just show the alert message
//       alert("Successfully registered");
//     });
//   });

