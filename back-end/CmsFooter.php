
</div>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


<script>
    function initializeSummernote(elementId) {
    const toolbar = [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
      
    ];

    const fontSizes = ['8', '9', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '36', '48',
        '72'
    ];

    const fontNames = ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'];
    
    $(elementId).summernote({
        height: 300,
        maxheight: 300,
        toolbar: toolbar,
        fontSizes: fontSizes,
        fontNames: fontNames
    });
}
</script>



<?php
    include "adminFooter.php";
?>