<?php session_start();
include('conn.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>AAC - Register</title>
	<link href="style.css" rel="stylesheet" type="text/css">
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
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$username = addslashes($username);
	$password = addslashes($password);

	$username = $conn->real_escape_string($username);
	$password = $conn->real_escape_string($password);

	$sql = "INSERT INTO user ( username, password ) VALUES({$username}, {$password})";

	if($conn->query($sql) === TRUE){
		header('location: index.php');
	}
}
?>
	</div>
</body>
</html>