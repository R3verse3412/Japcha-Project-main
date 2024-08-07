<?php
     include_once "../config/databaseConnection.php";
?>
<style>
    #mediaPreview img,
    #mediaPreview video {
        max-width: 100%;
    }
    .container{
        border: none !important;
        box-shadow: none !important;

    }
    video{
        max-width: 100% !important;
    }
.productImage{
    width: 100% !important;
}
 /* Define the style for the disabled button */
.disabled-button {
    /* Change the background color to gray */
    color: gray !important;
    text-decoration: none !important; /* Change the text color to white */
    cursor: not-allowed !important; /* Change the cursor to indicate it's not clickable */
}

.modal{
    /* width: 700px !important; */
}
.con{
    width: 30% !important;
}

</style>
<?php foreach ($products as $product): 
  
    $prodid = $product['product_id'];
    $image = $product['image_url'];
    ?>

    <div class="modal fade" id="edit<?= $prodid ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form class="formProducts" id="formProducts" action="../controller/addProducts.php" method="POST" autocomplete="off" enctype="multipart/form-data">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Product</h5>
                        <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <div class="form-group">
                            <label for="productname<?= $prodid ?>">Product Name:</label>
                            <input type="hidden" name ="prodId" value="<?= $prodid ?>">
                            <input type="text" class="form-control" id="productname<?= $prodid ?>" name="productname" required value="<?= $product['product_name'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select class="form-control" name="categoryid" required>
                                <option value="<?= $product['category_id'] ?>" selected disabled style="font-style: italic; color: gray;"><?= $product['category_name'] ?></option>
                                <?php
                                $query = "SELECT category_id, category_name FROM categories WHERE category_id != " . $product['category_id'];
                                $result = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $categoryId = $row['category_id'];
                                    $categoryName = $row['category_name'];
                                    echo '<option value="' . $categoryId . '">' . $categoryName . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="product_image<?= $prodid ?>">Product Image:</label>
                            <input class="form-control-file" type="file" accept="image/*, video/*" name="product_image" id="product_image<?= $prodid ?>">
                        </div>
                        <div class="form-group mb-0">
                            <input type="hidden" name="PrevMedia" value="<?= $product['image_url']?>">
                            <input type="hidden" name="PrevCat" value="<?= $product['category_id']?>">
                            <input type="hidden" name="PrevProdName" value="<?= $product['product_id']?>">
                            <input type="hidden" name="PrevDescription" value="<?= $product['description']?>">

                            <div id="mediaPreview<?= $prodid ?>" class="mediaPreview" style="max-width: 100%;"></div>
                          
                        </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="2" style="resize:none;" ><?= $product['description'] ?></textarea>
                    </div>

                    <div class="form-group mb-0">
                        <label>Allow Addons? <span class="badge"><input type="checkbox" name="enable_addons" <?php if ($product['allowAddons'] == true) echo 'checked'; ?>></span></label>
                    </div>
                    
                    
                    <div class="container m-0 p-0 d-flex flex-column gap-2">
                        <div class="header">
                            <input type="button" class="btn btn-link p-0" id="addButton<?= $prodid ?>" value="Add Size">
                        </div>
                        <div class="body d-flex flex-column gap-2" id="dynamic<?= $prodid ?>">
                        <?php
                                    
                                    $getSize =  $productModel->getSizeVariation($prodid);
                                    $count=0;
                                    foreach($getSize as $varSize):  
                                      $varid =  $varSize['variation_id'];        
                                      $PrevSize =  $varSize['size_id'];
                                      $PrevPrice =  $varSize['price'];                   
                                    ?>
                            <div class="container-list d-flex flex-row gap-2" id="containerList"> 
                                    <input type="hidden" name="varID[]" value="<?= $varSize['variation_id']?>">
                                    <input type="hidden" name="prevSize[]" value="<?= $varSize['size_id']?>">
                                    <input type="hidden" name="prevPrice[]" value="<?= $varSize['price']?>">
                                    <input type="hidden" class="prodId" value="<?= $prodid ?>">
                                <div class="con">
                                   
                                    <select class="form-control" name="sizes[]" id="variationSelect" data-selected-value="<?= $varSize['size_id'] ?>">
                                        
                                            <option selected  value="<?= $varSize['size_id']?>"><?= $varSize['size_name']?></option>
                                            <?php
                                           $query = "SELECT sizes_id, size_name FROM product_sizes WHERE isDeleted != 1 AND sizes_id != " . $varSize['size_id'];

                                            $result = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $SizeId = $row['sizes_id'];
                                                $SizeName = $row['size_name'];
                                                echo '<option  value="' . $SizeId . '">' . $SizeName . '</option>';
                                            }
                                        ?>
                                            
                                    </select>
                                </div>
                                <div><input type="number" name="prices[]" class="form-control" value="<?= $varSize['price']?>" required></div>
                                <div><i class="fa fa-minus-circle deleteICON" data-id="<?= $SizeId?>" style="cursor:pointer;" aria-hidden="true"></i></div>
                               
                            </div>
                            <?php
                            $count++;
                                endforeach;
                                
                                ?>
                        </div>
                    </div>
                    

                    </div>
                    <div class="modal-footer">
                        <button name="editProd" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    
  
<?php endforeach; ?>


<script>
   document.getElementById("product_image<?= $prodid ?>").addEventListener("change", function () {
    var fileInput = this;
    var mediaPreview = document.getElementById("mediaPreview<?= $prodid ?>");
    var productImage = document.getElementById("productImage<?= $prodid ?>");
    var productVideo = document.getElementById("productVideo<?= $prodid ?>");

    // Clear the mediaPreview element (remove its children)
    while (mediaPreview.firstChild) {
        mediaPreview.removeChild(mediaPreview.firstChild);
    }

    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var fileType = fileInput.files[0].type;

            if (fileType.startsWith('image/')) {
                // Handle images
                var newImage = document.createElement('img');
                newImage.src = e.target.result;
                newImage.style.maxWidth = '100%';
                mediaPreview.appendChild(newImage);
            } else if (fileType.startsWith('video/')) {
                // Handle videos
                var videoElement = document.createElement('video');
                videoElement.setAttribute('controls', '');
                var sourceElement = document.createElement('source');
                sourceElement.src = e.target.result;
                sourceElement.type = fileType;
                videoElement.appendChild(sourceElement);
                mediaPreview.appendChild(videoElement);
            } else {
                // Handle other file types or display an error message
                mediaPreview.innerHTML = 'Unsupported file type: ' + fileType;
                console.log('Unsupported file type: ' + fileType);
            }
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
});
</script>

<script>
$(document).ready(function() {
    <?php foreach ($products as $product): ?>
        var count<?= $product['product_id'] ?> = <?= $count ?>;
        var i<?= $product['product_id'] ?> = count<?= $product['product_id'] ?> + 1;
        var row<?= $product['product_id'] ?>;

        function getMaxRow<?= $product['product_id'] ?>() {
            $.ajax({
                url: '../controller/get_max_size_row.php', // Replace with the actual PHP file
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    row<?= $product['product_id'] ?> = parseInt(data.maxRow, 10) || 3;
                    toggleAddButton<?= $product['product_id'] ?>();
                },
                error: function() {
                    console.error("Failed to fetch the maximum row value.");
                }
            });
        }

        function toggleAddButton<?= $product['product_id'] ?>() {
            if (i<?= $product['product_id'] ?> > row<?= $product['product_id'] ?>) {
                $("#addButton<?= $product['product_id'] ?>").prop("disabled", true);
                $("#addButton<?= $product['product_id'] ?>").addClass("disabled-button");
            } else {
                $("#addButton<?= $product['product_id'] ?>").prop("disabled", false);
                $("#addButton<?= $product['product_id'] ?>").removeClass("disabled-button");
            }
        }

        getMaxRow<?= $product['product_id'] ?>();

        $("#addButton<?= $product['product_id'] ?>").click(function() {
            console.log("clickj");
            if (i<?= $product['product_id'] ?> < row<?= $product['product_id'] ?>) {
                i<?= $product['product_id'] ?>++;
                var selectOptions = '';
                $.ajax({
                    url: '../controller/get_size.php', // Replace with the actual PHP file to fetch sizes
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        data.forEach(function(option) {
                            selectOptions += '<option value="' + option.sizes_id + '">' + option.size_name + '</option>';
                        });

                        $('#dynamic<?= $product['product_id'] ?>').append(
                            '<div class="container-list d-flex flex-row gap-2" id="containerList<?= $product['product_id'] ?>' + i<?= $product['product_id'] ?> + '">' +
                            '<input type="hidden" name="varID[]" value="<?= $varid ?>">' +
                            '<input type="hidden" name="prevSize[]" value="<?=  $PrevSize ?>">' +
                            '<input type="hidden" name="prevPrice[]" value="<?= $PrevPrice ?>">' +
                            '<div class="con"><select class="form-control" name="sizess[]">' + selectOptions + '</select></div>' +
                            '<div><input type="number" name="pricess[]" class="form-control" required></div>' +
                            '<div><i class="fa fa-minus-circle delete" id="' + i<?= $product['product_id'] ?> + '" style="cursor:pointer;" aria-hidden="true"></i></div>' +
                            '</div>'
                        );
                        toggleAddButton<?= $product['product_id'] ?>();
                    },
                    error: function() {
                        console.error("Failed to fetch sizes.");
                    }
                });
            }
        });

        $(document).on('click', '.delete', function() {
            var row_id = $(this).attr("id");
            $('#containerList<?= $product['product_id'] ?>' + row_id + '').remove();
            i<?= $product['product_id'] ?>--;
            toggleAddButton<?= $product['product_id'] ?>();
        });

        toggleAddButton<?= $product['product_id'] ?>();

    <?php endforeach; ?>
});
</script>

    
<script>
$(document).ready(function() {
  // Function to handle variation deletion
  function deleteVariation(selectedValue, prodId) {
    // Use AJAX to send a request to mark the variation as deleted
    $.ajax({
      type: "POST",
      url: "../controller/mark_variation_deleted.php", // Specify the URL for your server-side script
      data: { id: selectedValue, prodId: prodId }, // Pass the ID, prodId, and selectedValue
      success: function(response) {
        if (response === "success") {
          // On success, update the select element's options
          alert("Access to the URL was successful.");

       // Remove the div elements with class "con" inside the container

        //   updateSelectOptions(selectedValue, prodId);
        } else {
          alert("Deletion failed: " + response);
        }
      }
    });
  }

  // Use event delegation to handle click events for dynamically created elements
  $(document).on("click", ".deleteICON", function() {
    var id = $(this).data("id");
    var prodId = $(this).closest(".container-list").find(".prodId").val();

    // Extract the selected value from the corresponding select element
   var selectedValue = $(this).closest(".container-list").find("select").val();
   var container = $(this).closest(".container-list");
    console.log(id);
    console.log(selectedValue);
    console.log(prodId);
    var confirmDeletion = confirm("Are you sure you want to delete this variation?");
    if (confirmDeletion) {
      deleteVariation(selectedValue, prodId);
      container.remove();
    }
  });




  
});


    </script>