<?php error_reporting(-1);?>
<!DOCTYPE html>
<html>
<head>
	<title>Music Viewer</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link href="viewer.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<div id="header">

		<h1>190M Music Playlist Viewer</h1>
		<h2>Search Through Your Playlists and Music</h2>

	</div>
	

	<div id="listarea">
		<ul id="musiclist">
			<?php 
			$playlist=$_REQUEST["playlist"];
			
			if($playlist==null){
				foreach (glob("songs/*.mp3") as $filename) { ?>
					<li class='mp3item'><a href='<?= $filename ?>'><?= basename($filename); ?></a> (
						<? if (filesize($filename)<1024) echo round((filesize($filename)),2)." bytes";
						   elseif(filesize($filename)>1048576) echo round((filesize($filename))/1048576,2)." Mb"; ?>
					)</li>
				<?php }
			}?>
			<?php
			if(isset($playlist)){
				$file = file($playlist);
				foreach ($file as $musicName) {
			?>
				<li class='mp3item'><a href='songs/<?= $musicName ?>'><?= $musicName;?></a> (
					
					<?php
						if (filesize("songs/".trim($musicName))<1024) echo (filesize("songs/".trim($musicName)))." bytes";
						elseif(filesize("songs/".trim($musicName))>1048576) echo round((filesize("songs/".trim($musicName)))/1048576,2)." Mb"; 
					?>
					

				)</li>
			
			<?php }} ?>

			<!-- basename will remain filename if we include second parameter it will delete it from filename -->

			<?php foreach (glob("songs/*.txt") as $filename) { ?>	
				<li class='playlistitem'><a href='music.php?playlist=<?= $filename ?>'> <?= basename($filename); ?></a> ( <?= (filesize($filename))." bytes"; ?>)</li>
			<?php } ?>
		</ul>
	</div>
</body>
</html>