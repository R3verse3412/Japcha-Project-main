$(document).ready(function() {
  $('.minus_discount_field').hide();
  $('#senior_discount_display').hide();
// Get references to the quantity input, price, and subtotal elements
const quantityInput = $("#quantity");
const addonsInput = $("#addonsPrice"); // Assuming this is the element displaying addons price
const priceElement = $("#price");
const subtotalElement = $("#subtotal");
const totalElement = $("#total");

$('#gcash-checkbox').on('click', function() {
// Get the file input element
const gcashPaymentUpload = $('#gcash_payment');

// Check if the checkbox is checked
if (this.checked) {
// Set the 'required' attribute for the file input
gcashPaymentUpload.prop('disabled', false).attr('required', 'required');
} else {
// Remove the 'required' attribute for the file input
gcashPaymentUpload.prop('disabled', true).removeAttr('required');
}
});



// Function to calculate subtotal
function calculateSubtotal() {
const quantity = parseInt(quantityInput.val(), 10);
let subtotal = 0;

if (quantity < 1 || isNaN(quantity)) {
quantityInput.val(1); // Reset to 1 if less than 1 or empty
}

const price = parseFloat(priceElement.text());

let addonsTotal = 0;
if (addonsInput !== null) {
addonsTotal = parseFloat(addonsInput.text()) || 0;
}

subtotal = (quantity * price + addonsTotal).toFixed(2);
subtotalElement.text(subtotal);
$("#subtotalInput").val(subtotal);

let total = parseFloat(subtotal);

if ($('#cod-checkbox').is(':checked')) {
total = (total + 10).toFixed(2); // Add a shipping fee of 10 if the checkbox is checked
$("#gcash_payment").prop('disabled', true);
}

if ($('#gcash-checkbox').is(':checked')) {
total = (total + 10).toFixed(2); // Add a shipping fee of 10 if the checkbox is checked
$("#gcash_payment").prop('disabled', false);
}

// if ($('#senior_discount').is(':checked')) {
// console.log("clicked");
// }

$('#senior_discount').each( function() {
    let senior_dis = 0;
  if ($(this).is(':checked')) {
    senior_dis = parseFloat($(this).val());
    $('#senior_discount_display').show();
    $('.span_discount_display').text(senior_dis);
    if (!isNaN(senior_dis)) {
      // Check if senior_dis is a valid number
      let discountAmount = (senior_dis / 100) * total;
      total = ( total - discountAmount).toFixed(2);
   $("#id_validate_senior").prop('disabled', false).attr('required', 'required');

    } else {
      console.error('Invalid discount percentage');
    }
  }else{
    $('#senior_discount_display').hide();
    $("#id_validate_senior").prop('disabled', true).removeAttr('required');

  }
});


  $(".exampleCheck").each(function () {
      let discount = 0;

      // Check if the current checkbox is checked
      if ($(this).is(':checked')) {
          // let discount = parseFloat($(this).val().split(' ')[0]) || 0;
          let couponInfo = $(this).val().split(' ');
          discount = parseFloat(couponInfo[0]) || 0;

          total = (total - discount).toFixed(2);
          $('.minus_discount_field').text(" - " + discount);
      }

  });

// Update the total again after adding shipping fees

totalElement.text(total);
$("#totalInput").val(total);
}

// Calculate and display subtotal when the page loads
calculateSubtotal();

// Add event listeners to listen for changes to the inputs
quantityInput.on("input", calculateSubtotal);
$('#cod-checkbox, #gcash-checkbox, #pickup-checkbox, #senior_discount').on('change', calculateSubtotal);



$("#senior_discount").on('change', function (){
    $("#senior_discount").not(this).prop('checked', false);
    calculateSubtotal();
  
  
});
$(".exampleCheck").on('change', function () {
// Uncheck other checkboxes
$(".exampleCheck").not(this).prop('checked', false);

// Calculate subtotal
calculateSubtotal();

// Check if the current checkbox is checked
if ($(this).is(':checked')) {
  $('.minus_discount_field').show();
} else {
  // If not checked, hide the discount field
  $('.minus_discount_field').hide();
}

});


$('#FormCheckout').submit(function (event) {
// Check if at least one checkbox is checked
const atLeastOneChecked = $('input[name="group[payment][gcash]"]:checked, input[name="group[payment][cod]"]:checked, input[name="group[payment][pickup]"]:checked').length > 0;

// If none are checked, prevent form submission
if (!atLeastOneChecked) {
    alert('Please select at least one payment method.');
    event.preventDefault(); // Prevent the form from being submitted
}


var quantity = document.querySelector('#quantity').value;


if (quantity > 15) {
    // Display an alert
    alert('You have reached the maximum limit (15).');
    

    event.preventDefault();

}
// Otherwise, the form will be submitted
});

});

function selectOnlyOne(checkbox) {
const shippingFeeElement = $("#shippingFee");

// Uncheck other checkboxes
$('input[name="group[payment][gcash]"], input[name="group[payment][cod]"], input[name="group[payment][pickup]"]').not(checkbox).prop('checked', false);

// Update the visibility of the shipping fee based on the selected checkbox
if (checkbox.checked && checkbox.id != "pickup-checkbox") {
shippingFeeElement.css('display', 'inline');
} else {
shippingFeeElement.css('display', 'none');
$("#gcash_payment").prop('disabled', true);
}


}