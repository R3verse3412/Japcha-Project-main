<?php
    include "customerProfileHeader.php";
?>
<div class="rightContainer">
    <div class="addressField"><h2>Address Book</h2></div>
      <div class="tableContainer">
              <table action="" >
                  <thead>
                    <tr>
                      <th>Type</th>
                      <th>Fullname</th>
                      <th>Address</th>
                      <th>Contact No.</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Home</td>
                      <td>Adner Devila</td>
                      <td>block 1 lot 1 phase 1</td>
                      <td>1234567890</td>
                      <td><button id="edit">EDIT</button></td>
                    </tr>
                    <tr>
                      <td>Work Address</td>
                      <td>Adner Devila</td>
                      <td>block 1 lot 1 phase 1</td>
                      <td>1234567890</td>
                      <td><button id="edit">EDIT</button></td>
                    </tr>
                  </tbody>
                  <?php
                          
                  ?>
              </table>
        </div>
      <div class="buttonContainer">
        <button id="addNew">+ Add New Address</button>
      </div>
</div>
    
    <div class="modalAddress">
      <form action="">
        <button class="form-close" onclick=""><i class="fa fa-close"></i></button>
        <div class="header">
          <div class="partition">
            <label for="addressName">Address Type</label>
            <input type="text" name="addressName">
          </div>
          <div class="partition">
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname">
          </div>
          <div class="partition">
            <label for="contact">Contact No.</label>
            <input type="tel" name="contact">
          </div>
        </div>
        <div class="body">
          <div class="addressContainer">
            <div class="addressHere">
              <label for="address">Address</label>
              <!-- <input type="text" name="address"> -->
              <textarea name="address" id="" cols="1" rows="3"></textarea>
            </div>
          </div>
          <div class="buttonContainer">
              <div class="buttons">
                <button id="del">Delete</button>
                <button id="save">Save Changes</button>
              </div>
          </div>
        </div>
      </form>
    </div>
    <script>
       const editBtn = document.getElementById('edit');
        const modal = document.querySelector('.modalAddress');
        const closeButton = document.querySelector('.form-close');

        editBtn.addEventListener('click', function(event) {
        event.preventDefault();
        modal.style.display = 'flex';
    });

        closeButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });           
    </script>
<?php
    include "customerProfileFooter.php";
?>