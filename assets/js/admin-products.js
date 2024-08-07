const addNewLink = document.getElementById('addNew');
const modal = document.querySelector('.modal1');
const closeButton = document.querySelector('.closeButton');
const modalupdate = document.querySelector('.modalupdate');
const updateButton = document.querySelector('.Edit');
const closeupdate = document.querySelector('.closeButton-update');

$(document).on('click', '#addNew', function() {
    document.getElementById('modal1').style.display = "flex";
    setTimeout(() => {
        document.getElementById('formProducts').style.transform = "scale(1)"; // Scale to 1 for the transition
    }, 10);
});

$(document).on('click', '.closeButton', function(){
    document.getElementById('formProducts').style.transform = "scale(0)";
    setTimeout(() => {
        document.getElementById('modal1').style.display = "none";
    }, 300);
});

$(document).on('click', '#btnMeals', function(){
    document.getElementById('modal2').style.display = "flex";
    setTimeout(() => {
        document.getElementById('modal2').style.transform = "scale(1)"; // Scale to 1 for the transition
      }, 10);
    
});

$(document).on('click', '.closeButton2', function(){
    document.getElementById('modal2').style.transform = "scale(0)";
    setTimeout(() => {
        document.getElementById('modal2').style.display = "none"; // Scale to 1 for the transition
      }, 300);
}); 



// function readURL(input) {
//     if (input.files && input.files.length > 0) {
//         for (var i = 0; i < input.files.length; i++) {
//             var reader = new FileReader();
//             var fileType = input.files[i].type;

//             reader.onload = (function (file) {
//                 return function (e) {
//                     if (fileType.startsWith('image/')) {
//                         // Handle image
//                         var imageElement = $('<img>').attr('src', e.target.result);
//                         $('#imageCon').append(imageElement); // Replace '#imageContainer' with your container element
//                     } else if (fileType.startsWith('video/')) {
//                         // Handle video
//                         var videoElement = $('<video controls>').attr('src', e.target.result);
//                         $('#imageCon').append(videoElement); // Replace '#videoContainer' with your container element
//                     } else {
//                         // Handle other types or display an error message
//                         console.log('Unsupported file type: ' + fileType);
//                     }
//                 };
//             })(input.files[i]);

//             reader.readAsDataURL(input.files[i]);
//         }
//     }
// }

var currentImage = null; // Variable to keep track of the currently displayed image

function readURL(input) {
    // if (input.files && input.files[0]) {
    //     var reader = new FileReader();
   
    //     reader.onload = function (e) {
    //         var fileType = input.files[0].type;
    //         var $imageCon = $('#imageCon'); // Cache the container element

    //         // Remove the currently displayed image or video
    //         if (currentImage) {
    //             currentImage.remove();
    //         }

    //         if (fileType.startsWith('image/')) {
    //             // Handle image
    //             var imageElement = $('<img>').attr('src', e.target.result);
    //             $imageCon.append(imageElement);
    //             currentImage = imageElement; // Set the current image
    //         } else if (fileType.startsWith('video/')) {
    //             // Handle video
    //             var videoElement = $('<video controls>').attr('src', e.target.result);
    //             $imageCon.append(videoElement); 
    //             currentImage = videoElement; // Set the current video
    //         } else {
    //             // Handle other types or display an error message
    //             console.log('Unsupported file type: ' + fileType);
    //         }
    //     }
   
    //     reader.readAsDataURL(input.files[0]);
    // }
}


let selectMenu = document.querySelector("#Category");
let container = document.querySelector(".productSection");

// selectMenu.addEventListener("change", function(){

//     let categoryName = this.value;
//     console.log(categoryName);
//     let http = new XMLHttpRequest();

//     http.onload = function(){
//         if(this.readyState == 4 && this.status == 200){
//             let response = JSON.parse(this.responseText);
//             let out = "";
//             for(let item of response){
//                 out += `
//                     <div class="boxContainer">
//                         <div class="productCon">
//                             ${item.image_url.includes('.mp4') ? 
//                                 `<video controls>
//                                     <source src="../upload/${item.image_url}" type="video/mp4">
//                                     Your browser does not support the video tag
//                                 </video>` : 
//                                 `<img src="../upload/${item.image_url}" alt="">`
//                             }
//                         </div>
//                         <div class="productDescription">
//                             <span>${item.product_name}</span>
//                             <p>₱</p>
//                         </div>
//                         <div class="productAction">
//                         ${showEdit ? 
//                                 `<div class="editContainer">
//                                     <img src="../image/editIcon.png" alt="">
//                                     <a href="#" class ="Edit" data-product-id="${item.product_id}">Edit</a>
//                                 </div>` 
//                             : ''}
                            
//                             ${showRemove ? 
//                                 `<div class="removeContainer">
//                                     <img src="../image/removeIcon.png" alt="">
//                                     <a href="controller/remove.php?deleteid=${item.product_id}" class="Remove">Remove</a>
//                                 </div>` 
//                                 : ''}
//                         </div>
//                     </div>
//                 `;
//             }
//             container.innerHTML =out;
//         }
//     }


//     http.open('POST', "../classes/SortByCategoryFunction.php");
//     http.setRequestHeader("content-type", "application/x-www-form-urlencoded");
//     http.send("category="+categoryName);

// });