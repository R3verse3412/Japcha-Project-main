<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
session_start();
?>
<style>
    .gradient-text {
      background: linear-gradient(45deg, yellow, black);
      -webkit-background-clip: text;
      color: transparent;
      display: inline-block;
    }
  </style>
  <input type="hidden" id="email_resend" value="<?= $_SESSION['register_CustomerEmail'] ?>">
  <input type="hidden" id="fname_resend" value="<?= $_SESSION['register_CustomerName'] ?>">
<div class="container-fluid vh-100" style="background-color: #fffbd5;">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-md-4">
            <div class="card" style="box-shadow: -1px 2px 4px 1px rgba(0, 0, 0, 0.25);">
            
                <div class="card-header">
                     <p><strong class="gradient-text">JAPCHA</strong>
                        
                    </p>
                    <h5 class="card-title">Verification Code:</h5>
                </div>
                <div class="card-body">
                    <form method="POST" id="otpForm">
                        <div class="form-group mt-3 position-relative">
                            <label for="otp">Enter Code</label>
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fa fa-key" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" class="form-control" name="otp" id="otp" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Enter the code" required>
                            </div>
                        </div>
                        <button type="button" id="verifyBtn" class="btn btn-success">Verify</button>
                        <button type="button" id="resendBtn" class="btn btn-warning">Resend</button>
                    </form>
                    <div id="verificationResult"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Handle OTP verification
    $("#verifyBtn").click(function() {

        var enteredOTP = $("#otp").val();
        console.log("click");
        // AJAX request to verify OTP
        $.ajax({
            type: "POST",
            url: "verify_signup.php", // Change to the actual verification script
            data: { otp: enteredOTP },
            success: function(response) {
                if (response === "success") {
                    $("#verificationResult").html("<div class='alert alert-success' role='alert'>Verification successful. Redirecting to home page...</div>");
                    // Redirect to home page after a short delay
                    setTimeout(function() {
                        window.location.href = "../index.php"; // Change to the actual home page URL
                    }, 2000); // 2000 milliseconds (2 seconds)
                } else if (response === "failure") {
                    $("#verificationResult").html("<div class='alert alert-danger' role='alert'>Invalid OTP</div>");
                } else if (response === "error") {
                    $("#verificationResult").html("<div class='alert alert-danger' role='alert'>Error during OTP verification</div>");
                } else if (response === "expired") {
                    $("#verificationResult").html("<div class='alert alert-warning' role='alert'>Session expired. Please try again.</div>");
                }
                else if (response === "unable") {
                    $("#verificationResult").html("<div class='alert alert-warning' role='alert'>Unable to signup user</div>");
                }
            },
            error: function() {
                $("#verificationResult").html("<p>Error during OTP verification</p>");
            }
        });
    });

var email_resend = $("#email_resend").val();
var fname_resend = $("#fname_resend").val();
    
    $("#resendBtn").click(function(){
        console.log("click");
        $.ajax({
                type: "POST",
                url: "resend_verifycode.php", // Change this to your server-side script
                data: {email: email_resend,
                       fname: fname_resend,        
                },
                success: function(response) {
                    console.log(response);
                    alert("Verification code has been resend!");
                },
                error: function(error) {
                    console.log(error);
                    // Handle error, e.g., show an error message
                }
            });

        
    });


});
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>



