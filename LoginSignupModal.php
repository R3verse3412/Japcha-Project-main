<style>
    .form-group {
        position: relative !important;
    }
    .form-group i{
        position: absolute;
    /* left: 0; */
        top: 20%;
        color: #c3baba !important;
    }
    .form-group input{
        border-top: none;
        border-right: none;
        border-left: none;
        padding-left: 1.5rem
    }
    .form-group input:focus {
        color: #495057;
        background-color: #fff;
        border-bottom-color: #005bb7 !important;
        /* outline: 0; */
        /* box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25); */
        box-shadow: none !important;
    }
    .form-group input:focus + i {
        color: #80bdff !important;
    }
    .wrapper {
  width: 200px;
  height: 60px;
  position: relative;
  z-index: 1;
}

.circle {
  width: 20px;
  height: 20px;
  position: absolute;
  border-radius: 50%;
  background-color: #fff;
  left: 15%;
  transform-origin: 50%;
  animation: circle7124 .5s alternate infinite ease;
}

@keyframes circle7124 {
  0% {
    top: 60px;
    height: 5px;
    border-radius: 50px 50px 25px 25px;
    transform: scaleX(1.7);
  }

  40% {
    height: 20px;
    border-radius: 50%;
    transform: scaleX(1);
  }

  100% {
    top: 0%;
  }
}

.circle:nth-child(2) {
  left: 45%;
  animation-delay: .2s;
}

.circle:nth-child(3) {
  left: auto;
  right: 15%;
  animation-delay: .3s;
}

.shadow {
  width: 20px;
  height: 4px;
  border-radius: 50%;
  background-color: rgba(0,0,0,0.9);
  position: absolute;
  top: 62px;
  transform-origin: 50%;
  z-index: -1;
  left: 15%;
  filter: blur(1px);
  animation: shadow046 .5s alternate infinite ease;
}

@keyframes shadow046 {
  0% {
    transform: scaleX(1.5);
  }

  40% {
    transform: scaleX(1);
    opacity: .7;
  }

  100% {
    transform: scaleX(.2);
    opacity: .4;
  }
}

.shadow:nth-child(4) {
  left: 45%;
  animation-delay: .2s
}

.shadow:nth-child(5) {
  left: auto;
  right: 15%;
  animation-delay: .3s;
}

.dot-spinner {
  --uib-size: 2.8rem;
  --uib-speed: .9s;
  --uib-color: #183153;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  height: var(--uib-size);
  width: var(--uib-size);
}

.dot-spinner__dot {
  position: absolute;
  top: 0;
  left: 0;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  height: 100%;
  width: 100%;
}

.dot-spinner__dot::before {
  content: '';
  height: 20%;
  width: 20%;
  border-radius: 50%;
  background-color: var(--uib-color);
  transform: scale(0);
  opacity: 0.5;
  animation: pulse0112 calc(var(--uib-speed) * 1.111) ease-in-out infinite;
  box-shadow: 0 0 20px rgba(18, 31, 53, 0.3);
}

.dot-spinner__dot:nth-child(2) {
  transform: rotate(45deg);
}

.dot-spinner__dot:nth-child(2)::before {
  animation-delay: calc(var(--uib-speed) * -0.875);
}

.dot-spinner__dot:nth-child(3) {
  transform: rotate(90deg);
}

.dot-spinner__dot:nth-child(3)::before {
  animation-delay: calc(var(--uib-speed) * -0.75);
}

.dot-spinner__dot:nth-child(4) {
  transform: rotate(135deg);
}

.dot-spinner__dot:nth-child(4)::before {
  animation-delay: calc(var(--uib-speed) * -0.625);
}

.dot-spinner__dot:nth-child(5) {
  transform: rotate(180deg);
}

.dot-spinner__dot:nth-child(5)::before {
  animation-delay: calc(var(--uib-speed) * -0.5);
}

.dot-spinner__dot:nth-child(6) {
  transform: rotate(225deg);
}

.dot-spinner__dot:nth-child(6)::before {
  animation-delay: calc(var(--uib-speed) * -0.375);
}

.dot-spinner__dot:nth-child(7) {
  transform: rotate(270deg);
}

.dot-spinner__dot:nth-child(7)::before {
  animation-delay: calc(var(--uib-speed) * -0.25);
}

.dot-spinner__dot:nth-child(8) {
  transform: rotate(315deg);
}

.dot-spinner__dot:nth-child(8)::before {
  animation-delay: calc(var(--uib-speed) * -0.125);
}

@keyframes pulse0112 {
  0%,
  100% {
    transform: scale(0);
    opacity: 0.5;
  }

  50% {
    transform: scale(1);
    opacity: 1;
  }
}



</style>
<div class="form-container">
            <i class="uil uil-times form_close"></i>
            <div class="form login_form">
                <!-- <form > -->
                    <h2>Login</h2>
                    <div class="input_box">
                        <input type="text" placeholder="Enter your email" name="email" id="UnameLogin" required/>
                        <i class="uil uil-envelope-alt email"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" placeholder="Enter your password" name="pass" id="PassLogin" required/>
                        <i class="uil uil-lock password"></i>
                        <!-- <i class="uil uil-eye-slash pw_hide"></i> -->
                    </div>
                    <!-- <div class="option_field">
                        <span class="checkbox">
                            <input type="checkbox" id="check">
                            <label for="check">Remember me</label>
                        </span>
                        <a href="#" class="forgot_pw">Forgot Password?</a>
                    </div> -->
                    <div class="alert alert-danger" id="AlertLogin" role="alert" style="margin-bottom: 0; margin-top: 5px; !important; display: none;">
                            This is a danger alert—check it out!
                    </div>
                    
                    <button class="btnLogin btn btn-primary" type="button" name="submit" id="LoginNow">Login Now</button>
  
                    <div class="login_signup">
                        Don't have an account? <a href="#" id="signup">Signup</a>
                    </div>
                <!-- </form> -->
            </div>
<script>
$(document).ready(function () {
    // Function to handle login logic
    function handleLogin() {
        var username = $("#UnameLogin").val();
        var pass = $("#PassLogin").val();

        if (!username || !pass) {

            $("#AlertLogin").fadeIn();
            $("#AlertLogin").text("Please fill in all fields.");
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'includes/login.inc.php',
            data: {
                username: username,
                pass: pass
            },
            success: function (response) {
                if (response === "success_customer") {
                    $("#AlertLogin").hide();

                    $("body").fadeOut(500, function () {
                        window.location.href = 'index.php';
                        alert("You have successfully logged in.");
                    });
                    
                } else if (response === "success_admin") {
                    $("#AlertLogin").hide();
                    $("body").fadeOut(500, function () {
                        window.location.href = 'back-end/AdminDashBoard.php';
                    });
                } else {

                    $("#AlertLogin").fadeIn();
                    $("#AlertLogin").text("Invalid username or password");
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.status);
                console.log(xhr.statusText);
                console.log(xhr.responseText);
                $(".dropdown-divider").show();
                $("#AlertLogin").fadeIn();
                $("#AlertLogin").text("Error during login. Please try again later.");
            }
        });
    }

    // Handle click event
    $("#LoginNow").click(function () {
        handleLogin();
    });

    $(".form_close").click(function(){
      $("#AlertLogin").hide();
    });
    // Handle enter key press
    $("#UnameLogin, #PassLogin").keypress(function (e) {
        if (e.which === 13) { // 13 is the key code for the Enter key
            e.preventDefault(); // Prevent default form submission
            handleLogin();
        }
    });

    // Handle form submission
    $("#LoginForm").submit(function (e) {
        e.preventDefault(); // Prevent default form submission
        handleLogin();
    });
});



</script>
            <!-- Signup form MODAL -->
            <div class="form signup_form">
                <!-- <form action="includes/signup.inc.php" method="POST"> -->
                    <div class="container-header mb-4">
                        <h2>Signup</h2>
                       
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="First Name" id="fname" name="fname" required />
                                <i class="uil uil-user user" style="color: #707070; left: 0;"></i>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Last Name" id="lname" name="lname" required />
                                <i class="uil uil-user user" style="color: #707070; left: 0;"></i>
                            </div>
                          
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Create password"  id="pass"  name="pass" required />
                                <i class="uil uil-lock password"></i>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Confirm password" id="confirm_pass"  name="confirm_pass" required />
                                <i class="uil uil-lock password"></i>
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter your email" id="email"  name="email" required />
                                <i class="uil uil-envelope-alt email"></i>
                            </div>

                        </div>
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Address block"  id="address" name="address" required />
                                <i class="uil uil-map-marker" style="color: #707070; left: 0;"></i>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Postal Code" id="Postal"  name="Postal" required />
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="City" id="City"  name="City" required />
                                    </div>
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Region" id="Region"  name="Region" required />
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Phone number (+63 9XX-XXX-XXXX)" id="contact"  name="contact" required />
                                <i class="uil uil-phone" style="color: #707070; left: 0;"></i>
                            </div>
                          
                        </div>
                    </div>
                   
                    <div class="container-footer">
                        <div class="option_field">
                            <span class="checkbox">
                                <input type="checkbox" id="terms" required>
                                <label for="terms">I agree to the <span style="color: #B4A30D; text-decoration: underline;"><a href="terms_and_conditions.php" target="_blank">Term of Service</a></span> & 
                                    <span style="color: #B4A30D; text-decoration: underline;"><a href="terms_and_conditions.php" target="_blank">Privacy Policy</a></span></label>
                            </span>  
                        </div>

                        <div class="alert alert-danger" id="AlertSignup" role="alert" style="display: none;">
                            This is a danger alert—check it out!
                        </div>

                        <div class="alert alert-success" id="AlertSignupSuccess" role="alert" style="display: none;">
                            This is a danger alert—check it out!
                        </div>

                        <button class="btnSignup btn btn-primary" type="button" name="signup_now">Register Now</button>
                        <div style="display: flex; justify-content: center;">
                            <div class="dot-spinner" style="display: none;">
                                <div class="dot-spinner__dot"></div>
                                <div class="dot-spinner__dot"></div>
                                <div class="dot-spinner__dot"></div>
                                <div class="dot-spinner__dot"></div>
                                <div class="dot-spinner__dot"></div>
                                <div class="dot-spinner__dot"></div>
                                <div class="dot-spinner__dot"></div>
                                <div class="dot-spinner__dot"></div>
                            </div>
                        </div>
                      
                        <div class="login_signup">
                            Already have an account? <a href="#" id="login">Login</a>
                        </div>
                    </div>
                    <!-- <input type="submit" class="btnLogin btn-primary"> -->
                    
                <!-- </form> -->
            </div>
        </div>

<script>
$(document).ready(function () {

    $(".btnSignup").click(function () {

      if (!$("#terms").prop("checked")) {
          $("#AlertSignup").text("Please accept the terms and conditions.");
            $("#AlertSignup").fadeIn();
            $("#AlertSignup").show();
            return;
        }
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var pass = $("#pass").val();
        var confirm_pass = $("#confirm_pass").val();
        var email = $("#email").val();
        var address = $("#address").val();
        var Postal = $("#Postal").val();
        var City = $("#City").val();
        var Region = $("#Region").val();
        var contact = $("#contact").val();

        $.ajax({
            type: 'POST',
            url: 'includes/SignUpRequest.php',
            data: {
                fname: fname,
                lname: lname,
                pass: pass,
                confirm_pass: confirm_pass,
                email: email,
                address: address,
                Postal: Postal,
                City: City,
                Region: Region,
                contact: contact,
            },
            success: function (response) {
                if (response.status === 'success') {
                    console.log('Success block executed.');  // Log to check if this block is reached
                    $("#AlertSignup").fadeOut();
                    $("#AlertSignup").hide();
                    $("#AlertSignupSuccess").text(response.message);
                    $("#AlertSignupSuccess").fadeIn();
                    $("#AlertSignupSuccess").show();
                    $(".dot-spinner").show();
                   // Redirect only if the server indicates a redirection
                        setInterval(() => {
                          window.location.href = "includes/signup.inc.php";
                        }, 5000);
                    
                } else if (response.status === 'error') {
                    handleErrors(response.errors);
                } else {
                    alert('Unexpected response');
                }
            },
            error: function (xhr, status, error) {
              console.log(xhr.status);  // HTTP status code
              console.log(xhr.statusText);  // HTTP status text
              console.log(xhr.responseText);  // Server response // Error thrown
              alert("Error during signup. Please try again later.");
            }
        });
    });

    function handleErrors(errors) {
        // Check for specific errors and display appropriate messages
        if (errors && errors.emptyInput) {
            $("#AlertSignup").text(errors.emptyInput);
            $("#AlertSignup").fadeIn();
            $("#AlertSignup").show();
            // alert(errors.emptyInput);
        } else if (errors && errors.invalidName) {
            $("#AlertSignup").text(errors.invalidName);
            $("#AlertSignup").fadeIn();
            $("#AlertSignup").show();
            // alert(errors.invalidName);
        } else if (errors && errors.invalidEmail) {
            $("#AlertSignup").text(errors.invalidEmail);
            $("#AlertSignup").fadeIn();
            $("#AlertSignup").show();
            // alert(errors.invalidEmail);
        } else if (errors && errors.pwdMatch) {
            $("#AlertSignup").text(errors.pwdMatch);
            $("#AlertSignup").fadeIn();
            $("#AlertSignup").show();
            // alert(errors.pwdMatch);
        } else if (errors && errors.uidTakenCheck) {
            $("#AlertSignup").text(errors.uidTakenCheck);
            $("#AlertSignup").fadeIn();
            $("#AlertSignup").show();
            // alert(errors.uidTakenCheck);
        } else if (errors && errors.validatePassword) {
            $("#AlertSignup").text(errors.validatePassword);
            $("#AlertSignup").fadeIn();
            $("#AlertSignup").show();
            // alert(errors.validatePassword);
        } else if (errors && errors.validateContact) {
            $("#AlertSignup").text(errors.validateContact);
            $("#AlertSignup").fadeIn();
            $("#AlertSignup").show();
            // alert(errors.validateContact);
        } else if (errors && errors.validatePostalCode) {
            $("#AlertSignup").text(errors.validatePostalCode);
            $("#AlertSignup").fadeIn();
            $("#AlertSignup").show();
            // alert(errors.validatePostalCode);
        } else {
            alert('Unknown error occurred');
        }
    }

    $(".form_close").click(function(){
      $("#AlertSignup").fadeOut();
      $("#AlertSignup").hide();
    });

});

</script>