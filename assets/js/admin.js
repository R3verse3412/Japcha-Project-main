// function openNav(){
//     var sidebar = document.getElementById("mySidebar");

//   if (sidebar.classList.contains("active")) {
//     sidebar.classList.remove("active");
//   } else {
//     sidebar.classList.add("active");
//   }
// }

let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e) => {
    console.log(e);
    let arrowParent = e.target.parentElement.parentElement;
    console.log(arrowParent);
    arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".menu");
let profileDetails = document.querySelector(".profile-details");

sidebarBtn.addEventListener("click", () => {
  sidebar.classList.toggle("close");
  // profileDetails.classList.toggle("close");
});
