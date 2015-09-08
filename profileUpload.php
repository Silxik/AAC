<?php 
session_start(); 
include('session.php');

$target_dir = "pildid/";
$target_file = $target_dir . basename($_FILES["iconUpload"]["tmp_name"]);
$uploadOk =1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"])){
	$check = getimagesize($_FILES["iconUpload"]["tmp_name"]);
	if($check !== false){
		echo "File is and image - " . $check["mime"] . ".";
		$uploadOk = 1;
	}else{
		echo "File is not an image.";
		$uploadOk = 0;
	}
}
// Image size
if($_FILES["iconUpload"]["size"] > 200000){
	echo "Image is too large!";
	$uploadOk = 0;
}
// Image type
$temp = explode(".",$_FILES["iconUpload"]["name"]);
$newfilename = $login_session . "_icon_thumb" . '.' . end($temp);
$file_path = $target_dir . $login_session . "_icon_thumb" . '.' . end($temp);
if($uploadOk == 1 && move_uploaded_file($_FILES["iconUpload"]["tmp_name"],$file_path)){
	$sql = "UPDATE user SET profile_image = '$file_path' WHERE username = '$login_session'";
	
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully" . "<br>";
		header('location: profile.php');
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
?>