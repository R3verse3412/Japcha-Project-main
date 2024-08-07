// const form = document.querySelector(".type-area"),
// inputField = form.querySelector("button"),
// sendBtn = form.querySelector("button");

// sendBtn.onclick = ()=>{
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "controller/SendChatMessageCustomer.php", true);
//     xhr.onload = () =>{
//         if(xhr.readyState === XMLHttpRequest.DONE){
//             if(xhr.status === 200){
//                 let data = xhr.response;
//                 console.log(data);
//                 if(data == "success"){
//                     location.href = "chatFront.php";
//                 }
//             }
//         }
//     }
//     let formData = new FormData(form);
//     xhr.send(formData);
// }