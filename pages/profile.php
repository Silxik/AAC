<? include('../system/main.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><? echo $_SESSION['login_user'];?> Page</title>
	<link rel="shortcut icon" type="image/x-icon" href="../res/img/favicon.ico" />
	<link href="../res/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="WebEditor">
		<textarea spellcheck="false" id="html_editor" name="html_editor"></textarea>
		<input class="html_post button" type="button" value="Save">
		<span class="save_msg">Successfully saved!</span>
	</div>
	<span id="EditorToggler">HTML Editor</span>
	<div id="divWrapper">
		
		<div id="header">
			<h1>Anime Addicts Continue~!</h1>
			<img class="logo" src="../res/img/AAC_logo.png" alt="logo">
		</div>

		<div id="nav"></div>
		<div id="profile">
			<b id="welcome">Welcome : <a href="profile.php"><? echo stripslashes($login_session); ?></a></b>
			<span class="icon" style="background-image:url('<?php	echo $row["profile_image"]; ?>');"></span>
			<b id="logout"><a href="logout.php">Log Out</a></b>
			<form id="iconUpload" action="profileUpload.php" method="post" enctype="multipart/form-data">
				<input type="file" name="iconUpload">
				<input class="button" type="submit" name="submit">
			</form>
		</div>

		<div id="currentlyOnline">
			<h2>Online:</h2>
			<div id="online">
			<?
			$user_sql = "SELECT username, profile_image FROM user WHERE log='in'";
			$user_result = $db->query($user_sql);
			while($userRow = $user_result->fetch_assoc()) {
				echo '<div class="user"><a href="profile_try.php">' . $userRow["username"]. '</a>' . '<span class="small_icon" style="background-image:url('. $userRow["profile_image"].');"></span></div>';
			}
			?>
			</div>
		</div>

		<!-- Post handling -->
		<div id="main">
			<form method="POST" action="upload.php" enctype="multipart/form-data">
				<textarea name="text"></textarea>
				<input class="button" name="postImage" type="file">
				<input class="button br" type="submit" name="newPost">
			</form>

			<?
			$sql = "SELECT text, postImage FROM userpost";
			$q = $db->query($sql);
			while($r = $q->fetch_assoc()){
				echo '<div class="post"><small>'. $r["post_date"] .'</small><pre>'. $r["text"] .'</pre><img class="postImg br" src="'. $r['postImage'] .'"></div>';
			}
			?>
		</div>

		<div id="footer"><p>Andres.spak@khk.ee. All rights reserved.</p></div>
	</div>
<script type="text/javascript" src="../res/js/main.js"></script>
</body>
</html>