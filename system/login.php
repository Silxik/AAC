<? include('main.php');

if (isset($_POST['un'])) {
	$un = $db->real_escape_string($_POST['un']);
	$pw = $db->real_escape_string($_POST['pw']);
	if (empty($un) || empty($pw)) {
		exit('Username or Password is missing!');
	} else {
		$result = $db->query("SELECT * FROM user WHERE password = sha('$pw') AND username = '$un'")->fetch_assoc();
		if ($result) {
			$db->query("UPDATE user SET online = '1' WHERE username='$un'");
			$_SESSION['user'] = $result;
			exit('Ok');
		} else {
			exit('Invalid Username or Password');
		}
	}
}

/*
$user = isset($_SESSION['user']) ? fetch("SELECT * from user WHERE username='$user'") : 0;

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
			$db->query("UPDATE user SET online = '1' WHERE username='$username'");
			$_SESSION['user'] = $username;
			header("location: index.php");
		} else {
			$error = "Username or Password is invalid";
		}
	}
}

*/