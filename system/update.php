<?
include("../system/main.php");

if(isset($_POST['passUpdate'])) {
	$id = $db->real_escape_string($_POST['userID']);
	$curPass = $db->real_escape_string($_POST['curPass']);
	$newPass = $db->real_escape_string($_POST['newPass']);
	$confirm = $db->real_escape_string($_POST['confirm']);

	$query = $db->query("SELECT username FROM user WHERE user_id=$id AND password=sha('$curPass')");

	if(mysqli_num_rows($query) > 0){
		$query = $db->query("UPDATE user SET password = sha('$newPass') WHERE user_id = $id");

		if($query){
			$result = $db->query("SELECT * FROM user WHERE user_id = '$id'");
            if ($result) {
                $_SESSION['user'] = $result->fetch_assoc();
				echo "<h3 class='success-header'>Password successfully changed!</h3>";
				$db->close();
            }
		} else {
			exit($db->error);
		}
	} else {
		exit("<h3 class='error-header'>Incorrect current password.</h3>");
	}
}

if(isset($_POST['mailUpdate'])) {
	$id = $db->real_escape_string($_POST['userID']);
	$curPass = $db->real_escape_string($_POST['curPass']);
	$newMail = $db->real_escape_string($_POST['newMail']);

	$query = $db->query("SELECT username FROM user WHERE user_id=$id AND password=sha('$curPass')");

	if(mysqli_num_rows($query) > 0){
		$query = $db->query("UPDATE user SET email = '$newMail' WHERE user_id = $id");

		if($query){
			$result = $db->query("SELECT * FROM user WHERE user_id = '$id'");
            if ($result) {
                $_SESSION['user'] = $result->fetch_assoc();
                header( "refresh:3;url=profile_edit_email_pass" );
                echo "<h3 class='success-header'>Email successfully changed!</h3>";
				$db->close();
            }
		} else {
			exit($db->error);
		}
	} else {
		exit("<h3 class='error-header'>Incorrect current password.</h3>");
	}
}
?>