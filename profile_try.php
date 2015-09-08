<?php
session_start();
include("session.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?php echo $login_session?> Page</title>
	<link rel="shortcut icon" type="image/x-icon" href="pildid/icon.ico" />
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="WebEditor">
	<form action="html_editor.php" method="post">
		<textarea spellcheck="false" id="html_editor" name="html_editor"><?php echo $row["code"]; ?></textarea>
		<input class="html_post button" name="submit" type="submit" value="Save">
		<span class="save_msg">Successfully saved!</span>
	</form>
	</div>
<span id="EditorToggler">HTML Editor</span>
<div id="divWrapper">

	<div id="header">
		<h1>Anime Addicts Continue~!</h1>
		<img class="logo" src="pildid/AAC_logo.png" alt="logo">
	</div>

	<div id="nav">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="#">Anime</a></li>
			<li><a href="#">Events</a></li>
			<li><a href="#">Discussion</a></li>
			<li><a href="#">Our group</a></li>
			<li><a href="#">Contact</a></li>
		</ul>
	</div>

	<div id="profile">
			<b id="welcome">Welcome : <a href="profile.php"><?php echo $login_session; ?></a></b>
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
		<?php
		$user_sql = "SELECT username, profile_image FROM user WHERE log='in'";
		$user_result = $conn->query($user_sql);
		while($userRow = $user_result->fetch_assoc()) {
			echo '<div class="user"><p>' . $userRow["username"]. '</p><span class="small_icon" style="background-image:url('. $userRow["profile_image"].');"></span></div>';
		}
		?>
		</div>
	</div>

	<div id="html_text">
		<?php echo $row["code"]; ?>
	</div>
	<div id="footer"><p>Andres.spak@khk.ee. All rights reserved.</p></div>
</div>
	<script src="javascript.js" type="text/javascript"></script>
</body>
</html>