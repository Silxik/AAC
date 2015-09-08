<?php session_start();
include('conn.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
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
	
	$username = stripslashes($username);
	$password = stripslashes($password);
	$username = $conn->real_escape_string($username);
	$password = $conn->real_escape_string($password);
	
	$rows = $conn->query("SELECT * FROM user WHERE username='$username'");
	$row_cnt = $rows->num_rows;
	
	$content = '<div id="main">
	<div id="html_text"></div>
	</div>';
	$content = addslashes($content);
	
	$sql = "INSERT INTO user (username, password, code) VALUES('$username', '$password', '$content')";
	
	if($username == "" || $password == ""){
		echo "Please enter a valid Username or Password";
		mysqli_close($conn);
	}else if($row_cnt == 1){
		echo "This username already exists.";
		mysqli_close($conn);
	}else if(strlen($username) < 3){
		echo "Username is too short!";
		mysqli_close($conn);
	}
	else{
		$conn->query($sql);
		$conn->query("UPDATE user SET log = 'in' WHERE username='$username'");
		$_SESSION['login_user'] = $username;
		header("location: index.php");
	}
}
?>
	</div>
</body>
</html>