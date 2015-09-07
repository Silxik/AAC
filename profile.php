<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?php echo $_SESSION['login_user'];?> Page</title>
	<link rel="shortcut icon" type="image/x-icon" href="pildid/icon.ico" />
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include('session.php'); ?>
	<div id="WebEditor">
		<textarea spellcheck="false" id="html_editor" name="html_editor"></textarea>
		<input class="html_post button" type="button" value="Save">
		<span class="save_msg">Successfully saved!</span>
	</div>
	<span id="EditorToggler">HTML Editor</span>
	<div id="divWrapper">
		
		<div id="header">
			<h1>Anime Addicts Continue~!</h1>
			<img class="logo" src="pildid/AAC_logo.png" alt="logo">
		</div>

		<div id="nav"></div>
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
			$user_sql = "SELECT username, profile_image FROM login WHERE log='in'";
			$user_result = $conn->query($user_sql);
			while($userRow = $user_result->fetch_assoc()) {
				echo '<div class="user"><a href="profile_try.php">' . $userRow["username"]. '</a>' . '<span class="small_icon" style="background-image:url('. $userRow["profile_image"].');"></span></div>';
			}
			?>
			</div>
		</div>
		<div id="main">
			<div id="html_text"></div>
			<div id="uploadForm">
				<form id="imageUpload" action="upload.php" method="post" enctype="multipart/form-data">
					<label for="fileToUpload">Select image to upload: </label><input type="file" name="fileToUpload" id="fileToUpload">
					<input class="button" type="submit" value="Upload Image" name="submit">
				</form>
			</div>
			<div id="imageContainer">
				<?php
				$target_dir = "pildid/upload/";
				$file_display = array('jpg', 'jpeg', 'png', 'gif');
				$dir_contents = scandir($target_dir);
				foreach ($dir_contents as $file) {
				  $file_type = strtolower(end(explode('.', $file)));
					if ($file !== '.' && $file !== '..' && in_array($file_type, $file_display) == true){
						echo '<img class="images" src="'. $target_dir. '/'. $file. '" alt="'. $file.'" />';
					}
				}
				?>
			</div>
		</div>

		<div id="footer"><p>Andres.spak@khk.ee. All rights reserved.</p></div>
	</div>
<script type="text/javascript" src="javascript.js"></script>
</body>
</html>