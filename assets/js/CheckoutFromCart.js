    
$(document).ready(function() {

  $('#gcash-checkbox').on('click', function() {
  // Get the file input element
  const gcashPaymentUpload = $('#gcash_payment');
  
  // Check if the checkbox is checked
  if (this.checked) {
  // Set the 'required' attribute for the file input
  gcashPaymentUpload.attr('required', 'required');
  } else {
  // Remove the 'required' attribute for the file input
  gcashPaymentUpload.removeAttr('required');
  }
  });
  // Function to calculate the total
  function calculateTotal() {
  let total = 0;
  
  // Iterate through each product row
  $('.product-row').each(function() {
  const price = parseFloat($(this).find('.product-price').text());
  const quantity = parseInt($(this).find('.product-quantity').val(), 10);
  const addonsPrice = parseFloat($(this).find('.addons-price').text()); // Get addons price
  const subtotal = (price * quantity + addonsPrice).toFixed(2);
  $(this).find('.product-subtotal').text('₱' + subtotal);
  
  total += parseFloat(subtotal);
  
  
  $(this).find('.subtotal-input').val(subtotal);
  });
  
  // Check if the "Cash on Delivery" checkbox is checked
  if ($('#cod-checkbox').is(':checked')) {
  total += 10; // Add a shipping fee of 10 if the checkbox is checked
  $("#gcash_payment").prop('disabled', true);
  }
  if ($('#gcash-checkbox').is(':checked')) {
  total += 10; // Add a shipping fee of 10 if the checkbox is checked
  $("#gcash_payment").prop('disabled', false);
  }
  
  $('#senior_discount').each( function() {
      let senior_dis = 0;
    if ($(this).is(':checked')) {
      senior_dis = parseFloat($(this).val());
      $('#senior_discount_display').show();
      $('.span_discount_display').text(senior_dis);
      if (!isNaN(senior_dis)) {
        // Check if senior_dis is a valid number
        let discountAmount = (senior_dis / 100) * total;
        total = ( total - discountAmount);
  
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
   
                  total = (total - discount);
                  $('.minus_discount_field').text(" - " + discount);
                  
              }
  });
  
  
  
  $('#totalInput').val(total);
  
  // Update the total in the HTML
  $('#total').text('₱' + total.toFixed(2));
  }
  
  // Calculate and display the total when the page loads
  calculateTotal();
  
  
  // Add an event listener to listen for changes to the input (quantity)
  $('.product-quantity').on('input', calculateTotal);
  
  $('#cod-checkbox, #gcash-checkbox, #pickup-checkbox, #senior_discount').on('change', calculateTotal);
  
  
  
  
  $(".exampleCheck").on('change', function () {
          $(".exampleCheck").not(this).prop('checked', false);
          calculateTotal();
  
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