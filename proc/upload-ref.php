<?php

/*
In order for this to work, upload_max_filesize and post_max_size in php.ini need to be set correctly
*/

$target_dir = "../music/";
$target_dir = $target_dir . basename( $_FILES["uploadFile"]["name"]);
$uploadOk=1;

/*Need to figure out how to check for file size being too big before dealing with it.
Or, just need to make php.ini able to handle large files. Not sure yet*/

if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_dir)) {
	$uploadOk=2;
    /*echo "The file ". basename( $_FILES["uploadFile"]["name"]). " has been uploaded.";*/
} else {
	$uploadOk=3;
    /*echo "Sorry, there was an error uploading your file.";*/
	}

header('Location: ../progress.php?msg=' . $uploadOk);
exit();

?> 