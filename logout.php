<?php
session_start();
include('session.php');
if(session_destroy()){
	$conn->query("UPDATE user SET log = 'out' WHERE username='$login_session'");
	header("Location: index.php");
}
?>