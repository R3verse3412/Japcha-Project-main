// JavaScript to toggle the display of the New Orders List
var newOrders = document.getElementById("newOrders");
var preparingOrders = document.getElementById("preparingOrders");
var orderInfo = document.getElementById("orderInfo");
var buttons = document.getElementById("buttons");
var deliveryOrders = document.getElementById("deliveryOrders");
var completeOrders = document.getElementById("completeOrders");
document.getElementById("newStatus").addEventListener("click", function() {

newOrders.style.display = "block";
preparingOrders.style.display = "none";
buttons.style.display = "block";
deliveryOrders.style.display = "none";
completeOrders.style.display = "none"
});

// JavaScript to toggle the display of the Preparing Orders List
document.getElementById("preparingStatus").addEventListener("click", function() {

  newOrders.style.setProperty("display", "none", "important");
  preparingOrders.style.display = "block";
  orderInfo.style.display = "none"; // Hide order info when "Preparing" is clicked
  buttons.style.display = "none"; // Hide the buttons
  deliveryOrders.style.display = "none";
  completeOrders.style.display = "none"
});

document.getElementById("deliveryStatus").addEventListener("click", function() {

  newOrders.style.setProperty("display", "none", "important");
  preparingOrders.style.display = "none";
  orderInfo.style.display = "none"; // Hide order info when "Preparing" is clicked
  buttons.style.display = "none"; // Hide the buttons
  completeOrders.style.display = "none"
  deliveryOrders.style.display = "block"
 
});

document.getElementById("completeStatus").addEventListener("click", function() {

  newOrders.style.setProperty("display", "none", "important");
  preparingOrders.style.display = "none";
  orderInfo.style.display = "none"; // Hide order info when "Preparing" is clicked
  buttons.style.display = "none"; // Hide the buttons
  deliveryOrders.style.display = "none";
  completeOrders.style.display = "block";
  clearAllButton.style.display = "block";
});