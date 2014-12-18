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
	ajax.open("POST", "file_upload_parser.php"); 
	ajax.send(formdata); 
} 

function progressHandler(event){ 
	//_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total; 
	var percent = (event.loaded / event.total) * 100; 
	_("progressBar").value = Math.round(percent);
	//_("msg").innerHTML = Math.round(percent)+"% uploaded... please wait";
} 

function completeHandler(event){ 
	//_("msg").innerHTML = event.target.responseText;
	_("progressBar").value = 0; 
} 

function errorHandler(event){ 
	_("msg").innerHTML = "Upload Failed"; 
} 

function abortHandler(event){ 
	_("msg").innerHTML = "Upload Aborted"; 
}