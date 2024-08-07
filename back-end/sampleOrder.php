<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<?php
    include "adminHeader.php";
?>
<style>
.row {
  padding-left: 330px;  
  margin-top: 200px;
    }

    .nav-item {
        margin-right: 20px;
        font-weight: bold;
        font-size: 25px;
        text-align: center;
        position: relative;
        color: black;
        padding: 20px 4px;
        max-width: 300%;
    }

    .nav-item::before {
        content: "";
        position: absolute;
        left: 0;
        bottom: 10;
        width: 100%;
        height: 5%;
        background: linear-gradient(transparent, black);
        z-index: -1;
        transition: 0.2s;
        transform: scaleY(0);
        border-bottom: 4px solid !important;
    }

    .nav-item.active::before {
        transform: scaleY(1);
    }


    .nav.nav-fill {
    width: 280px; 
    }

    .nav-item.nav-link {
        width: 140px; 
    }

    .table {
        margin-bottom: 100px;
        text-align: left;
        width: 900px;
        margin-left: 200px;   
        font-size: 25px;
        
    }

    .card-title{
      font-size: 20px;
    }

    .card-body{
      width: 550px;
      text-align: left;
      font-size: 20px;
    }

    .card-text{
      text-align: left;
      font-size: 20px;
    }

    .col{
      font-size: 55px;
    }

    hr.new4 {
  border: 3px solid black;
  width: 770px;
}

.Picture-Japcha{
    width: 300px;
    height: 350px;
}

.Cash{
    font-size: 25px;
}

</style>

     <div class="orderbar">
        <div class="row">
            <ul class="nav nav-tab justify-content-center " style="padding-right: 100px ">
                <li class="nav-item  " style="margin-right: 20px ">
                    <a class="nav-item nav-link active" id="nav-New-tab" data-toggle="tab" href="#nav-New" role="tab" aria-controls="nav-New" aria-selected="true">New</a>
                    </li>
                    <li class="nav-item "  style="margin-right: 20px ">
                    <a class="nav-item nav-link" id="nav-Prepairing-tab" data-toggle="tab" href="#nav-Prepairing" role="tab" aria-controls="nav-Prepairing" aria-selected="false">Prepairing</a>
                    </li>
                    <li class="nav-item "  style="margin-right: 20px ">
                    <a class="nav-item nav-link" id="nav-Delivery-tab" data-toggle="tab" href="#nav-Delivery" role="tab" aria-controls="nav-Delivery" aria-selected="false">Delivery</a>
                    </li>
                    <li class="nav-item  "  style="margin-right: 20px ">
                    <a class="nav-item nav-link" id="nav-Complete-tab" data-toggle="tab" href="#nav-Complete" role="tab" aria-controls="nav-Complete" aria-selected="false">Complete</a>
                    </li>
                    </ul>
                    </div>
                    
                </div>
                <div class="tab-content justify-content-center " id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-New" role="tabpanel" aria-labelledby="nav-New-tab">
                                <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">List Of Orders</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                  <td class="center-content">
                                            <div class="card w-75">
                                                <div class="card-body">
                                                    <h5 class="card-title">Order</h5>
                                                    <p class="card-text"># 00001</p>
                                                    <p class="card-text">₱ 200</p>
                                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#orderModal">View</a>
                                                    <a href="#" class="btn btn-danger">Remove</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document"> <!-- Dagdag ng `modal-lg` class dito -->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="orderModalLabel">Order Details</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Order Number:</strong> 00001</p>
                                                    <p><strong>Email:</strong> buzzb@gmail.com</p>
                                                    <p><strong>Address:</strong> blk1lot1dasma</p>
                                                    <p><strong>Customer Name:</strong>buzzb</p>
                                                    <hr class="new4">
                                                    <p><h2>Product Name</h2></p>
                                                    <img src="../image/Mango-shake.png" alt="Paris" class="Picture-Japcha">
                                                    <br>
                                                    <h2>Add-Ons</h2>
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                    <label class="form-check-label" for="exampleRadios1">Nata
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                    <label class="form-check-label" for="exampleRadios1">Jelly
                                                    </label>
                                                    </div>
                                                    <br>
                                                    <p class="Cash"><strong>Cash On Delivery:</strong> ₱ 200</p>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-dark" data-dismiss="modal">Accept</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <tr>
                                    <td class="center-content">
                                            <div class="card w-75">
                                                <div class="card-body">
                                                    <h5 class="card-title">Order</h5>
                                                    <p class="card-text"># 00002</p>
                                                    <p class="card-text">₱ 100</p>
                                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#orderModal1">View</a>
                                                    <a href="#" class="btn btn-danger">Remove</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="orderModal1" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document"> <!-- Dagdag ng `modal-lg` class dito -->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="orderModalLabel">Order Details</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Order Number:</strong> 00002</p>
                                                    <p><strong>Email:</strong>lass@gmail.com</p>
                                                    <p><strong>Address:</strong> blk2lot2dasma</p>
                                                    <p><strong>Customer Name:</strong> lass</p>
                                                    <hr class="new4">
                                                    <p><h2>Product Name</h2></p>
                                                    <img src="../image/dark-choco.png" alt="Paris" class="Picture-Japcha">
                                                    <h2>Add-Ons</h2>
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                    <label class="form-check-label" for="exampleRadios1">Nata
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                    <label class="form-check-label" for="exampleRadios1">Jelly
                                                    </label>
                                                    </div>
                                                    <br>
                                                    <p class="Cash"><strong>Cash On Delivery:</strong> ₱ 100</p>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-dark" data-dismiss="modal">Accept</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </tr>
                    </tbody>
                </table>
            </div>
    <div class="tab-pane fade" id="nav-Prepairing" role="tabpanel" aria-labelledby="nav-Prepairing-tab">
    <table class="table">
        <thead>
        <!-- Table header content goes here -->
        </thead>
        <tbody>
            <tr>
                <td class="center-content">
                    <div class="card w-75">
                        <div class="card-body">
                            <h5 class="card-title">Order</h5>
                            <p class="card-text">#00001</p>
                            <p class="card-text">₱ 200</p>
                            <!-- Add a data-toggle and data-target attributes to open the modal -->
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#orderModal2">View</a>
                            <a href="#" class="btn btn-danger">Remove</a>
                            <a href="#" class="btn btn-warning">Delivery</a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="center-content">
                    <div class="card w-75">
                        <div class="card-body">
                            <h5 class="card-title">Order</h5>
                            <p class="card-text">#00001</p>
                            <p class="card-text">₱ 100</p>
                            <!-- Add a data-toggle and data-target attributes to open the modal -->
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#orderModal3">View</a>
                            <a href="#" class="btn btn-danger">Remove</a>
                            <a href="#" class="btn btn-warning">Delivery</a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="orderModal2" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="orderModalLabel">Order Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <p><strong>Order Number:</strong> 00001</p>
             <p><strong>Email:</strong> buzzb@gmail.com</p>
            <p><strong>Address:</strong> blk1lot1dasma</p>
            <p><strong>Customer Name:</strong>buzzb</p>
             <hr class="new4">
             <p><h2>Product Name</h2></p>
            <img src="../image/Mango-shake.png" alt="Paris" class="Picture-Japcha">
             <br>
             <h2>Add-Ons</h2>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">Nata
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">Jelly
            </label>
            </div>
            <br>
            <p class="Cash"><strong>Cash On Delivery:</strong> ₱ 200</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
             <button type="button" class="btn btn-dark" data-dismiss="modal">Accept</button>
             </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="orderModal3" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="orderModalLabel">Order Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Order Number:</strong> 00002</p>
                <p><strong>Email:</strong>lass@gmail.com</p>
                <p><strong>Address:</strong> blk2lot2dasma</p>
                <p><strong>Customer Name:</strong> lass</p>
                <hr class="new4">
                <p><h2>Product Name</h2></p>
                <img src="../image/dark-choco.png" alt="Paris" class="Picture-Japcha">
                <h2>Add-Ons</h2>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                <label class="form-check-label" for="exampleRadios1">Nata
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                <label class="form-check-label" for="exampleRadios1">Jelly
                </label>
                </div>
                <br>
                <p class="Cash"><strong>Cash On Delivery:</strong> ₱ 100</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-dark" data-dismiss="modal">Accept</button>
            </div>
        </div>
    </div>
</div>

					<div class="tab-pane fade" id="nav-Delivery" role="tabpanel" aria-labelledby="nav-Delivery-tab">
          <table class="table">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="center-content"><div class="card w-75">
                                          <div class="card-body">
                                            <h5 class="card-title">Order</h5>
                                            <p class="card-text">#00001</p>
                                            <p class="card-text">₱ 200</p>
                                            <a href="#" class="btn btn-dark">Complete</a>
                                          </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center-content"><div class="card w-75">
                                          <div class="card-body">
                                            <h5 class="card-title">Order</h5>
                                            <p class="card-text">#00001</p>
                                            <p class="card-text">₱ 100</p>
                                            <a href="#" class="btn btn-dark">Complete</a>
                                          </div>
                                        </div>
                                        </td>
                                    </tr>
                    </tbody>
                </table>
					</div>
					<div class="tab-pane fade" id="nav-Complete" role="tabpanel" aria-labelledby="nav-Complete-tab">
          <table class="table">
                                <thead>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="center-content"><div class="card w-75">
                                          <div class="card-body">
                                            <h5 class="card-title">Order</h5>
                                            <p class="card-text">#00001</p>
                                            <p class="card-text">₱ 200</p>
                                            <a href="#" class="btn btn-danger">Remove</a>
                                          </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center-content"><div class="card w-75">
                                          <div class="card-body">
                                            <h5 class="card-title">Order</h5>
                                            <p class="card-text">#00001</p>
                                            <p class="card-text">₱ 100</p>
                                            <a href="#" class="btn btn-danger">Remove</a>
                                          </div>
                                        </div>
                                        </td>
                                    </tr>
                    </tbody>
                </table>
	            </div>
	            </div>
              </div>
              </div>
              </div>

      

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php
    include "adminFooter.php";

?>
  