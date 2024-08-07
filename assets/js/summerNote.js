
// function initializeSummernote(elementId) {
//     const toolbar = [
//         ['style', ['bold', 'italic', 'underline', 'clear']],
//         ['font', ['strikethrough', 'superscript', 'subscript']],
//         ['fontname', ['fontname']],
//         ['fontsize', ['fontsize']],
//         ['color', ['color']],
//         ['para', ['ul', 'ol', 'paragraph']],
//         ['height', ['height']],
//         ['insert', ['link', 'picture', 'video']]

//     ];

//     const fontSizes = ['8', '9', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '36', '48',
//         '72'
//     ];

//     const fontNames = ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'];
    
//     $(elementId).summernote({
//         toolbar: toolbar,
//         fontSizes: fontSizes,
//         fontNames: fontNames
//     });
// }
// // $(document).ready(function (){
// //     // save buttons
// //     $('#saveJapcha').on('click', function () {
// //         // Send an AJAX request to retrieve content
// //         const content = $('#japcha').summernote('code');
    
// //         $.ajax({
// //             method: 'POST', // Use GET method to fetch data
// //             url: '../classes/save_note.php',
// //             data: { content: content }, // PHP script to retrieve content
// //             success: function (response) {
// //                 // Set the retrieved content in the SummerNote editor
// //                 alert('Content saved successfully.');
// //             },
// //             error: function (xhr, status, error) {
// //                 alert('Error saving content: ' + error);
// //             }
// //         });
// //     });

// //     $('#saveOrder').on('click', function () {
// //         // Send an AJAX request to retrieve content
// //         const orders = $('#order').summernote('code');
    
// //         $.ajax({
// //             method: 'POST', // Use GET method to fetch data
// //             url: '../classes/save_note.php',
// //             data: { order: orders }, // PHP script to retrieve content
// //             success: function (response) {
// //                 // Set the retrieved content in the SummerNote editor
// //                 alert('updated successfully.');
// //                 console.log(orders);
// //             },
// //             error: function (xhr, status, error) {
// //                 alert('Error saving content: ' + error);
// //             }
// //         });
// //     });

// //     $('#saveSocials').on('click', function () {
// //         // Send an AJAX request to retrieve content
// //         const social = $('#socials').summernote('code');
    
// //         $.ajax({
// //             method: 'POST', // Use GET method to fetch data
// //             url: '../classes/save_note.php',
// //             data: { social: social }, // PHP script to retrieve content
// //             success: function (response) {
// //                 // Set the retrieved content in the SummerNote editor
// //                 alert('updated successfully.');
// //                 console.log(social);
// //             },
// //             error: function (xhr, status, error) {
// //                 alert('Error saving content: ' + error);
// //             }
// //         });
// //     });

// //     $('#savePolicy').on('click', function () {
// //         // Send an AJAX request to retrieve content
// //         const policy = $('#policy').summernote('code');
    
// //         $.ajax({
// //             method: 'POST', // Use GET method to fetch data
// //             url: '../classes/save_note.php',
// //             data: { policy: policy }, // PHP script to retrieve content
// //             success: function (response) {
// //                 // Set the retrieved content in the SummerNote editor
// //                 alert('updated successfully.');
// //                 console.log(policy);
// //             },
// //             error: function (xhr, status, error) {
// //                 alert('Error saving content: ' + error);
// //             }
// //         });
// //     });

// //     $('#saveLocation').on('click', function () {
// //         // Send an AJAX request to retrieve content
// //         const location = $('#location').summernote('code');
    
// //         $.ajax({
// //             method: 'POST', // Use GET method to fetch data
// //             url: '../classes/save_note.php',
// //             data: { location: location }, // PHP script to retrieve content
// //             success: function (response) {
// //                 // Set the retrieved content in the SummerNote editor
// //                 alert('updated successfully.');
// //                 console.log(location);
// //             },
// //             error: function (xhr, status, error) {
// //                 alert('Error saving content: ' + error);
// //             }
// //         });
// //     });

// //     $('#saveContact').on('click', function () {
// //         // Send an AJAX request to retrieve content
// //         const contact = $('#contact').summernote('code');
    
// //         $.ajax({
// //             method: 'POST', // Use GET method to fetch data
// //             url: '../classes/save_note.php',
// //             data: { contact: contact }, // PHP script to retrieve content
// //             success: function (response) {
// //                 // Set the retrieved content in the SummerNote editor
// //                 alert('updated successfully.');
// //                 console.log(contact);
// //             },
// //             error: function (xhr, status, error) {
// //                 alert('Error saving content: ' + error);
// //             }
// //         });
// //     });

// //     $('#saveTitle').on('click', function () {
// //         // Send an AJAX request to retrieve content
// //         const title_data = $('#title').summernote('code');
    
// //         $.ajax({
// //             method: 'POST', // Use GET method to fetch data
// //             url: '../classes/save_note.php',
// //             data: { title_data: title_data }, // PHP script to retrieve content
// //             success: function (response) {
// //                 // Set the retrieved content in the SummerNote editor
// //                 alert('updated successfully.');
// //                 console.log(title_data);
// //             },
// //             error: function (xhr, status, error) {
// //                 alert('Error saving content: ' + error);
// //             }
// //         });
// //     });

// //     $('#saveSubtitle').on('click', function () {
// //         // Send an AJAX request to retrieve content
// //         const subtitle = $('#Subtitle').summernote('code');
    
// //         $.ajax({
// //             method: 'POST', // Use GET method to fetch data
// //             url: '../classes/save_note.php',
// //             data: { subtitle: subtitle }, // PHP script to retrieve content
// //             success: function (response) {
// //                 // Set the retrieved content in the SummerNote editor
// //                 alert('updated successfully.');
// //                 console.log(subtitle);
// //             },
// //             error: function (xhr, status, error) {
// //                 alert('Error saving content: ' + error);
// //             }
// //         });
// //     });

// //     // Save Link
// //     $('#fbBtn').on('click', function () {
// //         // Send an AJAX request to retrieve content
// //         const fbLink = $('#fbLink').val();
    
// //         $.ajax({
// //             method: 'POST', // Use GET method to fetch data
// //             url: '../classes/save_note.php',
// //             data: { fbLink: fbLink }, // PHP script to retrieve content
// //             success: function (response) {
// //                 // Set the retrieved content in the SummerNote editor
// //                 alert('updated successfully.');
// //                 console.log(fbLink);
// //             },
// //             error: function (xhr, status, error) {
// //                 alert('Error saving content: ' + error);
// //             }
// //         });
// //     });
    

// //     retrieveAndDisplayData();

// //             // Function to retrieve and display data
// //             function retrieveAndDisplayData() {
// //                 // Send an AJAX request to retrieve the content
// //                 $.ajax({
// //                     method: 'GET',
// //                     url: '../classes/retrieve_note.php', // The PHP script to retrieve data
// //                     success: function (response) {
// //                         // Display the retrieved content in a <div> element
// //                         $('#displayContent').html(response);
// //                     },
// //                     error: function (xhr, status, error) {
// //                         alert('Error retrieving content: ' + error);
// //                     }
// //                 });
// //             }
    

//     // $('#AboutUs').on('click', function(){
//     //     $.ajax({
//     //         url:"../back-end/CmsAboutUs.php",
//     //         method:"post",
//     //         data:{record:1},
//     //         success:function(data){
//     //             $('.CmsBodyContainer').html(data);
//     //         }
//     //     });
//     // });
//     // $('#SocialLink').on('click', function(){
//     //     $.ajax({
//     //         url:"../back-end/CmsSocialMediaLink.php",
//     //         method:"post",
//     //         data:{record:1},
//     //         success:function(data){
//     //             $('.CmsBodyContainer').html(data);
//     //         }
//     //     });
//     // });
// // });


// // cms landing page
// $(document).ready(function () {
//     $('#upload-form').on('submit', function (e) {
//         e.preventDefault(); // Prevent the default form submission

//         var fileInput = $('#file-input')[0]; // Get the file input element
//         if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
//             alert('Please select a file to upload.');
//             return;
//         }

//         var formData = new FormData(this);

//         $.ajax({
//             url: '../classes/upload-file-cms.php',
//             type: 'POST',
//             data: formData,
//             processData: false,
//             contentType: false,
//             success: function (data) {
//                 $('#result').html(data.message);
//                 alert("uploaded successfully");
//             },
//             error: function (error) {
//                 console.error('Error:', error);
//             }
//         });
//     });
// });
