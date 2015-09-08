<?php
include('conn.php');
if(isset($_SESSION['login_user'])){
	$login_session = $_SESSION['login_user'];
	
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