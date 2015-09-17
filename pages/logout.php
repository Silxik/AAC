<?
if(session_destroy()){
	$db->query("UPDATE user SET online = '0' WHERE username='{$user['username']}");
	header('Location:' . BASE_URL);
}
?>