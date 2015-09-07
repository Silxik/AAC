<?php
session_start();
include('session.php');
if(session_destroy()){
	$conn->query("UPDATE login SET log = 'out' WHERE username='$login_session'");
	header("Location: index.php");
}
?>