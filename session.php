<?php
include('conn.php');
if(isset($_SESSION['login_user'])){
	$user_check = $_SESSION['login_user'];
	$ses_sql = "SELECT username, profile_image FROM user WHERE username='$user_check'";
	$query = $conn->query($ses_sql);
	$row = $query->fetch_assoc();
	$login_session = $row['username'];
	
	$inactive = 600;
	if( !isset($_SESSION['timeout']) )
	$_SESSION['timeout'] = time() + $inactive; 
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive){
		$conn->query("UPDATE user SET log = 'out' WHERE username='$login_session'");
		session_destroy();
		header("Location: index.php");
	}
	$_SESSION['timeout']=time();
}
?>