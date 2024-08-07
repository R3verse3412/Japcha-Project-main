<?php
   include "../classes/dbh.classes.php";
   include "../classes/cms.classes.php";
   include "../classes/cms-cntrl.classes.php";
   include "../classes/cms-view-classes.php";
   $cmsinfo = new CmsInfoView();
?>

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="../customer.css">
<div>


    <nav >
        <div id ="logo-img">
            <a href="index.php" class="logo__image">
                <img src="../upload-content/<?php $cmsinfo->fetchLogo();?>" alt="Japcha Logo">
            </a>
        </div>
       
    </nav>
<div class="home">
        <div id="banner">
            <h1>
                <?php
                    $cmsinfo->fetchTitle();
                 ?>
             </h1>
            <h2>
                <?php
                    $cmsinfo->fetchSubtitle();
                 ?>
            </h2>
            <a href="#" class="btn-Shopnow">SHOP NOW</a>
        </div>
        <div id="image-right-side">
                <img src="../image/image-hand.png" alt="Hand holding JapCha">
        </div>

        <!-- LOGIN FORM MODAL -->
        <div class="form-container">
            <i class="uil uil-times form_close"></i>
            <div class="form login_form">
                <form action="includes/login.inc.php" method="POST">
                    <h2>Login</h2>
                    <div class="input_box">
                        <input type="text" placeholder="Enter your email" name="email" required/>
                        <i class="uil uil-envelope-alt email"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" placeholder="Enter your password" name="pass" required/>
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>
                    <div class="option_field">
                        <span class="checkbox">
                            <input type="checkbox" id="check">
                            <label for="check">Remember me</label>
                        </span>
                        <a href="#" class="forgot_pw">Forgot Password?</a>
                    </div>
                    <button class="btnLogin" type="submit" name="submit">Login Now</button>

                    <div class="login_signup">
                        Don't have an account? <a href="#" id="signup">Signup</a>
                    </div>
                </form>
            </div>
          
            <!-- Signup form MODAL -->
            <div class="form signup_form">
                <form action="../includes/signup.inc.php" method="POST">
                    <h2>Signup</h2>
                    <div class="input_box">
                        <input type="text" placeholder="Fullname" name="userName" required />
                        <i class="uil uil-user user" style="color: #707070; left: 0;"></i>
                    </div>
                    <div class="input_box">
                        <input type="email" placeholder="Enter your email"  name="email" required />
                        <i class="uil uil-envelope-alt email"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" placeholder="Create password" name="pass" required />
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" placeholder="Confirm password" name="confirm_pass" required />
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>
                    <div class="input_box">
                        <input type="text" placeholder="Default Address" name="address" required />
                        <i class="uil uil-map-marker" style="color: #707070; left: 0;"></i>
                    </div>
                    <div class="input_box">
                        <input type="tel" placeholder="Phone number" name="contact" required />
                        <i class="uil uil-phone" style="color: #707070; left: 0;"></i>
                        <!-- <i class="uil uil-eye-slash pw_hide"></i> -->
                    </div>
                    <div class="option_field">
                        <span class="checkbox">
                            <input type="checkbox" id="terms">
                            <label for="terms">I aggree to the <span style="color: #B4A30D; text-decoration: underline;">Term of Service</span> & 
                                <span style="color: #B4A30D; text-decoration: underline;">Privacy Policy</span></label>
                        </span>  
                    </div>
                    <!-- <input type="submit" class="btnLogin btn-primary"> -->
                    <button class="btnSignup" type="submit" name="submit">Signup Now</button>
                    <div class="login_signup">
                        Already have an account? <a href="#" id="login">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <a href="#" class="heading1">
            <h2 class="section-heading">ABOUT US</h2>
        </a>
        <section id="about-us-container">
                <div id="left-div">
                    <div class="container-description">
                        <div class="description-japcha">
                            <div class="header">
                            <h2>What is JapCha?</h2>
                            <button class="btnCaretdown" onclick=""><i id="caret_down" class="fa fa-caret-down arrow"></i></button>
                            </div>
                            <div class="paragraph-desc">
                                    <textarea name="" id="" cols="10" rows="5" > <?php  $cmsinfo->fetchJapcha();?> </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="container-description">
                        <div class="description-japcha">
                            <div class="header">
                            <h2>How to Order</h2>
                            <button class="btnCaretdown" onclick=""><i id="caret_down" class="fa fa-caret-down arrow"></i></button>
                            </div>
                            <div class="paragraph-desc">         
                                <textarea name="" id="" cols="10" rows="5" > <?php  $cmsinfo->fetchHowToOrder();?> </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="container-description">
                        <div class="description-japcha">
                            <div class="header">
                            <h2>Our Socials</h2>
                            <button class="btnCaretdown" onclick=""><i id="caret_down" class="fa fa-caret-down arrow"></i></button>
                            </div>
                            <div class="paragraph-desc">
                                
                                    <textarea name="" id="" cols="10" rows="5" > <?php  $cmsinfo->fetchSocials();?> </textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div id="right-div">
            <div class="container-description">
                        <div class="description-japcha">
                            <div class="header">
                            <h2>Policy</h2>
                            <button class="btnCaretdown" onclick=""><i id="caret_down" class="fa fa-caret-down arrow"></i></button>
                            </div>
                            <div class="paragraph-desc">
                                    <textarea name="" id="" cols="10" rows="5" >Lorem ipsum dolor sit   </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="container-description">
                        <div class="description-japcha">
                            <div class="header">
                            <h2>Our Location</h2>
                            <button class="btnCaretdown" onclick=""><i id="caret_down" class="fa fa-caret-down arrow"></i></button>
                            </div>
                            <div class="paragraph-desc">
                                    
                                    <textarea name="" id="" cols="10" rows="5" >Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores id reprehenderit cupiditate est mollitia magni voluptatibus animi totam fugit doloribus quia, perspiciatis quidem excepturi obcaecati quisquam fugiat veniam. Cumque, accusamus?</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="container-description">
                        <div class="description-japcha">
                            <div class="header">
                            <h2>Contact Us</h2>
                            <button class="btnCaretdown" onclick=""><i id="caret_down" class="fa fa-caret-down arrow"></i></button>
                            </div>
                            <div class="paragraph-desc">
                                
                                    <textarea name="" id="" cols="10" rows="5" >Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores id reprehenderit cupiditate est mollitia magni voluptatibus animi totam fugit doloribus quia, perspiciatis quidem excepturi obcaecati quisquam fugiat veniam. Cumque, accusamus?</textarea>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
     </main>
<?php
     require '../classes/save_note_Model.php';
     require_once '../classes/save_note_View.php';
     $AboutUsInfo = new SampleView();
?>
<footer>
        <div id="footer-container">
            <div id="social-media-footer">
                <ul>
                    <li>
                        <a href="<?= $AboutUsInfo->fetchFbLinks(); ?>">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $AboutUsInfo->fetchYtLinks(); ?>">
                            <i class="fa fa-youtube"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $AboutUsInfo->fetchIgLinks(); ?>">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="visitUs">
                <h3>VISIT AND CONTACT US</h3>
            </div>
        </div>
     </footer>
     <script src="../customer.js"></script> 

     <script>
            let arrow = document.querySelectorAll(".arrow");
            let paragraph = document.querySelectorAll(".paragraph-desc");
            for (var i = 0; i< arrow.length; i++){
            arrow[i].addEventListener("click", (e)=>{
                console.log(e);
                let arrowParent = e.target.parentElement.parentElement.parentElement;
                console.log(arrowParent);
                arrowParent.classList.toggle("show");
            });
            }
     </script>
</div>