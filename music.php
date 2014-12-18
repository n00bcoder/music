<html>
<head>
	<title>traveling music</title>
	<meta charset="utf-8">
    <meta content="width=device-width, initial-scale=0.6" name="viewport">
	<link rel="stylesheet" href="./css/player-style.css" type="text/css" />
	<link rel="stylesheet" href="./css/font.css" type="text/css" />
    <script src="./js/jquery.js"></script>
    <script src="./js/audiojs/audio.min.js"></script>
    <script> /* Script written by Adam Khoury @ DevelopPHP.com */ /* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */ 
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
        var percent = (event.loaded / event.total) * 100; 
        _("progressBar").value = Math.round(percent);
        //_("msg").innerHTML = Math.round(percent)+"% uploaded... please wait"; 
    } 
    
    function completeHandler(event){ 
        _("msg").innerHTML = event.target.responseText; 
        _("progressBar").value = 0; 
        _("upload-file").value = "";
    } 
    
    function errorHandler(event){ 
        _("msg").innerHTML = "Upload Failed"; 
    } 
    
    function abortHandler(event){ 
        _("msg").innerHTML = "Upload Aborted"; 
    }
    </script>
    <script>
      $(function() { 
        // Setup the player to autoplay the next track
        var a = audiojs.createAll({
          trackEnded: function() {
            var next = $('ol li.playing').next();
            if (!next.length) next = $('ol li').first();
            next.addClass('playing').siblings().removeClass('playing');
            audio.load($('a', next).attr('data-src'));
            audio.play();
          }
        });
        
        // Load in the first track
        var audio = a[0];
            first = $('ol a').attr('data-src');
        $('ol li').first().addClass('playing');
        audio.load(first);

        // Load in a track on click
        $('ol li').click(function(e) {
          e.preventDefault();
          $(this).addClass('playing').siblings().removeClass('playing');
          audio.load($('a', this).attr('data-src'));
          audio.play();
        });
        // Keyboard shortcuts
        $(document).keydown(function(e) {
          var unicode = e.charCode ? e.charCode : e.keyCode;
             // right arrow
          if (unicode == 39) {
            var next = $('li.playing').next();
            if (!next.length) next = $('ol li').first();
            next.click();
            // back arrow
          } else if (unicode == 37) {
            var prev = $('li.playing').prev();
            if (!prev.length) prev = $('ol li').last();
            prev.click();
            // spacebar
          } else if (unicode == 32) {
            audio.playPause();
          }
        })
      });
    </script>
</head>
<body>
<div id="container">
	<div id="myheader">
		<div id="logo">
			<h2 id="title">traveling music</h2>
		</div>
		<form id="upload-form" method="post" enctype="multipart/form-data">
			<div class="upload-form-item">
				<input id="upload-file" type="file" name="upload-file">
			</div>
			<div class="upload-form-item">
				<input type="button" id="upload-button" value="Upload File" onclick="uploadFile()">
			</div>
			<div id="msg-block">
				<progress id="progressBar" value="0" max="100" style="width:300px;"></progress> 
			</div>
		</form>
	</div>
	<div id="content">
		<div id="player">
			  <audio preload></audio>
		<div id="myshortcuts">
			<div>
				<h1>Keyboard shortcuts:</h1>
				<p><em>&rarr;</em> Next track</p>
				<p><em>&larr;</em> Previous track</p>
				<p><em>Space</em> Play/pause</p>
			</div>
		</div>
		</div>
	<div id="playlist">
		<ol>
			<?php include('./proc/list_files.php'); ?>
		</ol>
	</div>
    <div>
        <p id="msg"></p>    
    </div>
	</div>
</div>
</body>
</html>