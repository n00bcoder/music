<?php
/*if ($handle = opendir("./music")) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            echo '<li><a href="#" data-src="./music/' . "$entry" . '">' . "$entry" . "</a></li>";
        }
    }
    closedir($handle);
}

$tag = id3_get_tag( "../music/Live_at_DiPiazzas.mp3" );
print_r($tag);*/

$songs = glob('./music/*.mp3');

foreach ($songs as $song) {
	echo '<li><a href="#" data-src="' . "$song" . '">' . basename($song) . '</a></li><div class="playlist-dl-cont"><p class="playlist-dl-link"><a href="' . "$song" . '" download>Download</a></p></div>';
}
?>
