<?php

if($_POST['password'] === "glorious music") {
        header("location:../music.php");
} else { 
	header("location:../index.html");
}

?>