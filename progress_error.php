<?php
$msg = @$_GET['msg'];
if($msg == '1') {
	echo '<p class="msg">Nothing happened!</p>';
	} elseif($msg == '2') {
	echo '<p class="msg">Success!</p>';
	} elseif($msg == '3') {
	echo '<p class="msg">Error!</p>';
	} elseif($msg == '4') {
	echo '<p class="msg">File tooo big!</p>';
	}
?>