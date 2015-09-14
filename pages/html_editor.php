<?
include('system/main.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$data = $_POST['html_editor'];
	$data = addslashes($data);
	$sql = "UPDATE login SET code = '$data' WHERE username = '$login_session'";
	$conn->query($sql);
	header('location: profile_try.php');
}
?>