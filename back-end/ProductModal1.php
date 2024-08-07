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
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form class="formProducts" id="formProducts" action="../controller/addProducts.php" method="POST" autocomplete="off" enctype="multipart/form-data">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 70vh;  overflow-y: auto;">
                    <div class="form-group">
                        <label for="productname">Product Name:</label>
                        <input type="text" class="form-control" id="productname" name="productname" required>
                    </div>

                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select class="form-control" name="category" required>
                            <option value="default" selected disabled style="font-style: italic; color:gray;">Category</option>
                            <?php
                            $query = "SELECT category_id, category_name FROM categories WHERE isDeleted != 1";
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
                        <label for="product_image">Product Image:</label>
                        <input class="form-control-file" type="file" accept="image/*, video/*" name="product_image" id="product_image">
                    </div>
                    <div class="form-group">
                        <div id="mediaPreview" style="max-width: 100%;"></div>
                        <!-- <img id="imagePreview" class="img-thumbnail"  /> -->
                    </div>
                   
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="2" style="resize:none;"></textarea>
                    </div>

                    <div class="form-group mb-0">
                        <label>Allow Addons? <span class="badge"><input type="checkbox" name="enable_addons" id=""></span></label>
                    </div>
                    
                    <div class="container m-0 p-0 d-flex flex-column gap-2">
                        <div class="header">
                            <input type="button" class="btn btn-link p-0" id="addButton" value="Add Size">
                        </div>
                        <div class="body d-flex flex-column gap-2" id="dynamic">
                            <div class="container-list d-flex flex-row gap-2" id="containerList"> 
                                <div class="con">
                                    <select class="form-control" name="sizes[]">
                                         <?php
                                            $query = "SELECT sizes_id, size_name FROM product_sizes WHERE sizes_id = 7";
                                            $result = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $SizeId = $row['sizes_id'];
                                                $SizeName = $row['size_name'];
                                                echo '<option selected  value="' . $SizeId . '">' . $SizeName . '</option>';
                                            }
                                        ?>
                                        <?php
                                            $query = "SELECT sizes_id, size_name FROM product_sizes WHERE sizes_id != 7 AND isDeleted != 1";
                                            $result = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $SizeId = $row['sizes_id'];
                                                $SizeName = $row['size_name'];
                                                echo '<option  value="' . $SizeId . '">' . $SizeName . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div><input type="number" name="prices[]" class="form-control" required></div>
                                <div><i class="fa fa-minus-circle delete" id="a" style="cursor:pointer;" aria-hidden="true"></i></div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <button name="addProd" type="submit" class="btn1">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // JavaScript to preview the selected image
    document.getElementById("product_image").addEventListener("change", function () {
    var fileInput = this;
    var mediaPreview = document.getElementById("mediaPreview");

    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var fileType = fileInput.files[0].type;
            if (fileType.startsWith('image/')) {
                // Handle image
                mediaPreview.innerHTML = ''; // Clear previous content
                var imageElement = document.createElement('img');
                imageElement.src = e.target.result;
                mediaPreview.appendChild(imageElement);
            } else if (fileType.startsWith('video/')) {
                // Handle video
                mediaPreview.innerHTML = ''; // Clear previous content
                var videoElement = document.createElement('video');
                videoElement.setAttribute('controls', '');
                var sourceElement = document.createElement('source');
                sourceElement.src = e.target.result;
                sourceElement.type = fileType;
                videoElement.appendChild(sourceElement);
                mediaPreview.appendChild(videoElement);
            } else {
                // Handle other types
                mediaPreview.innerHTML = 'Unsupported file type: ' + fileType;
                // You can throw an exception or display an error message here.
                console.log('Unsupported file type: ' + fileType);
            }
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
});

    $(document).ready(function() {
        var i = 2;
        var row;

        function getMaxRow() {
        $.ajax({
            url: '../controller/get_max_size_row.php', // Replace with the actual PHP file
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                row = parseInt(data.maxRow, 10) || 3; // Use the fetched 'maxRow' or default to 3
                toggleAddButton(); // Initial toggle of the Add button
            },
            error: function() {
                console.error("Failed to fetch the maximum row value.");
            }
        });
    }

        function toggleAddButton() {
            if (i > row) {
                $("#addButton").prop("disabled", true);
                $("#addButton").addClass("disabled-button");
            } else {
                $("#addButton").prop("disabled", false);
                $("#addButton").removeClass("disabled-button");
            }
        }
        getMaxRow();
        $("#addButton").click(function() {
            if (i < row) {
                i++;
                var selectOptions = '';
                $.ajax({
                    url: '../controller/get_size.php', // Replace with the actual PHP file to fetch sizes
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        data.forEach(function(option) {
                            selectOptions += '<option value="' + option.sizes_id + '">' + option.size_name + '</option>';
                        });

                        $('#dynamic').append(
                            '<div class="container-list d-flex flex-row gap-2" id="containerList' + i + '">' +
                            '<div class="con"><select class="form-control" name="sizes[]">' + selectOptions + '</select></div>' +
                            '<div><input type="number" name="prices[]" class="form-control" required></div>' +
                            '<div><i class="fa fa-minus-circle delete" id="' + i + '" style="cursor:pointer;" aria-hidden="true"></i></div>' +
                            '</div>'
                        );
                        toggleAddButton();
                    },
                    error: function() {
                        console.error("Failed to fetch sizes.");
                    }
                });
            }
        });

        $(document).on('click', '.delete', function() {
            var row_id = $(this).attr("id");
            $('#containerList' + row_id + '').remove();
            i--;
            toggleAddButton();
        });

        toggleAddButton();
    });

</script>
