<?php
session_start();
$error='';
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
	$error = "Username or Password is invalid";
	} else {
		$username=$_POST['username'];
		$password=$_POST['password'];

		$conn = new mysqli("localhost", "andresspak", "maoch7zo", "andresspak_vs14");

		$username = stripslashes($username);
		$password = stripslashes($password);

		$username = $conn->real_escape_string($username);
		$password = $conn->real_escape_string($password);

		$query = $conn->query("SELECT username, password FROM login WHERE password='$password' AND username='$username'");
		$rows = $query->num_rows;
		if ($rows == 1) {
			$conn->query("UPDATE login SET log = 'in' WHERE username='$username'");
			$_SESSION['login_user'] = $username;
			header("location: index.php");
		} else {
			$error = "Username or Password is invalid";
		}
	}
}
?>