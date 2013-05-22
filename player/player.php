<?php
	$film = $_GET["f"];
	
	if(isset($_GET["q"]))
		$q = $_GET["q"];
	else
		$q = "hd";
?>
<style>
body {
	margin:0;
	padding:0;
	background:black;
}
</style>
<link href="player.css" rel="stylesheet">
<script src="player.js"></script>
<video id="my_video_1" class="video-js vjs-default-skin" controls preload="auto" width="940" height="530" data-setup="{}">
  <source src="../videos/<?php if($q=='sd') echo 'sd/'; echo $film; ?>.mp4" type='video/mp4'>
</video>
