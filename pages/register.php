<? include('../system/main.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>AAC - Register</title>
	<link href="../res/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="register">
		<form action="register.php" method="POST">
			<h2>Register</h2>
			<label for="username">Choose username: </label><input name="username" type="text" autocomplete="off" placeholder="Enter username here...">
			<label for="password">Choose password: </label><input name="password" type="password" placeholder="Enter password here...">
			<input class="button" name="submit" type="submit" value="Register">
		</form>
<?php
if(isset($_POST['submit'])){
	$username = $db->real_escape_string($_POST["username"]);
	$password = $db->real_escape_string($_POST["password"]);

	$sql = "INSERT INTO user (username, password, date_joined) VALUES('$username', sha('$password'), CUR_DATE())";

	$rows = $db->query("SELECT * FROM user WHERE username='$username'");
	$row_cnt = $rows->num_rows;

	if(empty($username) || empty($password)){
		echo "Please enter a valid Username or Password";
	}else if($row_cnt === 1){
		echo "This username already exists.";
	}else if(strlen($username) < 3){
		echo "Username is too short!";
	}else{
		$db->query($sql);
		$db->query("UPDATE user SET online = '1' WHERE username='$username'");
		$_SESSION['login_user'] = $username;
		header("location: index.php");
	}

	mysqli_close($db);
}
?>
	</div>
</body>
</html>