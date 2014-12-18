<?php 

$fileName = $_FILES["upload-file"]["name"]; // The file name 
$fileTmpLoc = $_FILES["upload-file"]["tmp_name"]; // File in the PHP tmp folder 
$fileType = $_FILES["upload-file"]["type"]; // The type of file it is 
$fileSize = $_FILES["upload-file"]["size"]; // File size in bytes 
$fileErrorMsg = $_FILES["upload-file"]["error"]; // 0 for false... and 1 for true 
if (!$fileTmpLoc) { 
    // if file not chosen 
    echo "ERROR: Please browse for a file before clicking the upload button."; exit(); 
} 
if(move_uploaded_file($fileTmpLoc, "../progresstest/$fileName")){ 
    echo "$fileName upload is complete"; 
} else { 
    echo "move_uploaded_file function failed"; } 

?>