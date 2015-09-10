<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
	<link rel="shortcut icon" type="image/x-icon" href="pildid/icon.ico" />
	<title>Home Page</title>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<?php include('session.php');?>
	<body>
	<div id="divWrapper">
		<div id="header"></div>

		<div id="nav"></div>
		
		<div id="profile">
			<?php if(isset($_SESSION['login_user'])){?>
				<b id="welcome">Welcome : <a href="profile.php"><?php echo stripslashes($login_session); ?></a></b>
				<span class="icon" style="background-image:url('<?php	echo $row["profile_image"]; ?>');"></span>
				<b id="logout"><a href="logout.php">Log Out</a></b>
				<form id="iconUpload" action="profileUpload.php" method="post" enctype="multipart/form-data">
					<input type="file" name="iconUpload" value="Choose image">
					<input class="button" type="submit" value="Upload Image" name="submit">
				</form>
			<?php } else { ?>
				<form action="login.php" method="post" autocomplete="off">
					<label for="username">UserName :</label>
					<input id="name" name="username" placeholder="username" type="text">
					<label for="password">Password :</label>
					<input id="password" name="password" placeholder="**********" type="password">
					<input class="button" name="submit" type="submit" value=" Login ">
					<a class="button" href="register.php">Register</a>
				</form>
			<?php } ?>
			
		</div>
		
		<div id="currentlyOnline">
			<h2>Online:</h2>
			<div id="online">

			</div>
		</div>

		<div id="main">
			<h1>Hi <?php if(isset($_SESSION['login_user'])){echo stripslashes($login_session). "!";};?></h1>
			<h2>Welcome to Anime Addicts Continue!</h2>
			<p>This site is currently under developement. Please stay in tune for further information!</p>
		</div>


		<div id="footer">
			<p>AAC.com All rights reserved</p>
		</div>
	</div>
<script type="text/javascript" src="javascript.js"></script>
</body>
</html>