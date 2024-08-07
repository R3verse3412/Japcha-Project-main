let popup = document.getElementById("addAdminPopup");
// let overlay = document.getElementById("modalOverlay");
function openAddAdmin()
{
    popup.classList.add("open-form");
//    modalOverlay.style.display = "block";
}
function closeAddAdmin()
{
  popup.classList.remove("open-form");
//   modalOverlay.style.display = "none";
}
function closeModal(event) {
if (event.target === modalOverlay || event.key === "Escape") {
closePopup();
}
}

// Listen for clicks on the modal overlay
modalOverlay.addEventListener("click", closeModal);

// Listen for keydown events to close the modal when "Escape" key is pressed
document.addEventListener("keydown", closeModal);