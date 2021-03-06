<!DOCTYPE html>
<html>
<head>
<title>Progress test</title>
<meta charset="UTF-8" />
<link rel="stylesheet" href="./css/progress.css" type="text/css" />
<script type="text/javascript" src="./js/jquery.js"></script>
<script type="text/javascript">
    function _(el){ 
	return document.getElementById(el); 
} 

function uploadFile(){ 
	var file = _("upload-file").files[0]; 
	//alert(file.name+" | "+file.size+" | "+file.type); 
	var formdata = new FormData(); 
	formdata.append("upload-file", file); 
	var ajax = new XMLHttpRequest(); 
	ajax.upload.addEventListener("progress", progressHandler, false); 
	ajax.addEventListener("load", completeHandler, false); 
	ajax.addEventListener("error", errorHandler, false); 
	ajax.addEventListener("abort", abortHandler, false); 
	ajax.open("POST", "./proc/upload.php"); 
	ajax.send(formdata); 
} 

function progressHandler(event){ 
	//_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total; 
    //$("progress").addClass("show-thing");
    $("#msg").innerHTML = "";
    $("#msg").removeClass("fade-thing");
	var percent = (event.loaded / event.total) * 100; 
	_("progress-bar").value = Math.round(percent);
} 

function completeHandler(event){ 
	//_("msg").innerHTML = event.target.responseText;
	//_("progressBar").value = 0; 
    $("#msg").addClass("fade-thing");
    _("msg").innerHTML = "Success!";
    _("upload-file").value = "";
    _("progress-bar").value = 0;
    //$("progress").removeClass("show-thing").addClass("hide-thing");
    //$("#msg").addClass("show-thing").addClass("fade-thing");
} 

function errorHandler(event){ 
	_("msg").innerHTML = "Upload Failed"; 
} 

function abortHandler(event){ 
	_("msg").innerHTML = "Upload Aborted"; 
}
    </script>
</head>
<body>
<form id="upload-form" method="post" enctype="multipart/form-data">
	<div class="upload-form-item">
		<input id="upload-file" type="file" name="upload-file">
	</div>
	<div class="upload-form-item">
		<input type="button" value="Upload File" onclick="uploadFile();">
	</div>
	<div id="msg-block">
		<div id="msg">test
		</div>
		<div id="progress-block">
			<progress id="progress-bar" value="0" max="100"></progress>
		</div>
	</div>
</form>