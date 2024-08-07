<?php
 include "../includes/db.inc.php";
 
 $sql = "SELECT sample_note FROM sample_table ORDER BY sample_id DESC LIMIT 1"; // Retrieve the latest content
 $result = mysqli_query($conn, $sql);
 
 if ($result) {
     // Fetch the content from the query result
     $row = mysqli_fetch_assoc($result);
     $content = $row['sample_note'];
 
     // Decode HTML entities to render content properly
     $decodedContent = htmlspecialchars_decode($content);
 
     // Send the decoded content as a response
     echo $decodedContent;
 } else {
     echo "Error: " . mysqli_error($conn);
 }
 mysqli_close($conn);
