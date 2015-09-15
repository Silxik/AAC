<?
include('../system/main.php');

if(session_destroy()){
	$db->query("UPDATE user SET online = '0' WHERE username='$user'");
	header("Location: index.php");
}
?>