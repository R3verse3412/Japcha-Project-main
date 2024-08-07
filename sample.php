<?php
    include "c_header.php";
?>
<div class="container d-flex " style="height: 100vh; background: black; justify-content: center; align-items: center;">

<div class="alert" style="position: absolute; width: 600px; height:400px; background: white; z-index: 9999; right: 500px;
display: none;">

</div>


<div class="card p-2 mt-3" style="width: 18rem;">
    <div class="card-header" style="max-height: 100px;">
            <img src="image/coffe_bean.jpg" alt="" style="max-height: 100px;">
    </div>
    <div class="card-body" style="background: blue;">

    </div>
    <div class="card-footer">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="..." alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>


<!-- Modal -->


<script>
    $(document).ready(function(){
        
        // $(".btn").click(function(){
        //     $(".alert").fadeIn();
        //     $(".alert").show();
        // });
    });
</script>
<?php
    include "c_footer.php";
?>