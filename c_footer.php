<?php
     require_once 'classes/dbh.classes.php';
     require 'classes/save_note_Model.php';
     require_once 'classes/save_note_View.php';
     $AboutUsInfo = new SampleView();
?>
<footer>
        <div id="footer-container">
            <div id="social-media-footer">
                <ul>
                    <li>
                        <a href="<?php echo $data['fbLink']; ?>">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $data['ytLink']; ?>">
                            <i class="fa fa-youtube"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $data['instagramLink']; ?>">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="visitUs">
                <h3>VISIT AND CONTACT US</h3>   
            </div>
            <span style="color: black; font-size: 12px;"><span>Copyright</span> <i class="fa fa-copyright" aria-hidden="true"></i> <span>2023, JapCha</span></span>
        </div>
     </footer>
    
     <script>
  $(document).ready(function(){
    // Retrieve active link from localStorage on page load
    var activeLink = localStorage.getItem('activeLink');

    // Set "Home" as the default active link if not stored
    if (!activeLink) {
      $(".nav-link[href='index.php']").addClass("active");
    } else {
      // Set "active" class to the retrieved active link
      $('.nav-link[href="' + activeLink + '"]').addClass('active');
    }

    // Add click event listener to all links with class "nav-link"
    $(".navigation__main_ul").on("click", ".nav-link", function(){
      // Remove "active" class from all links
      $(".nav-link").removeClass("active");
      
      // Add "active" class to the clicked link
      $(this).addClass("active");

      // Store the clicked link in localStorage
      localStorage.setItem('activeLink', $(this).attr('href'));
    });
  });
</script>

     <script src="customer.js"></script> 
</body>
</html>