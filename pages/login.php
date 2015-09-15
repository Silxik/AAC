<? include('../system/main.php');
$error='';
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
	$error = "Username or Password is invalid";
	} else {
		$username = $db->real_escape_string($_POST['username']);
		$password = $db->real_escape_string($_POST['password']);

		$query = $db->query("SELECT username, password FROM user WHERE password= sha('$password') AND username='$username'");
		$rows = $query->num_rows;
		if ($rows == 1) {
			$db->query("UPDATE user SET log = 'in' WHERE username='$username'");
			$_SESSION['user'] = $username;
			header("location: index.php");
		} else {
			$error = "Username or Password is invalid";
		}
	}
}
?>