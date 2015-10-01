<?
$target_dir = "uploads/files";
$target_file = $target_dir . basename($_FILES["post_attachment"]["name"]);
if(isset($_POST["newPost"])) {
    $id = $db->real_escape_string($_POST['id']);
    $text = $db->real_escape_string($_POST['text']);
    // Check file size
    if($_FILES["post_attachment"]["size"] > 83886100) {
        exit("Sorry, your file is too large.");
    }
    elseif (file_exists($target_dir) == false) {
        exit('Directory \''. $target_dir. '\' not found!');
    } else {
        $i = "INSERT INTO userpost (user_id, text) VALUES ('$id', '$text')";
        $s = "INSERT INTO files (file_name) VALUES ('$target_file')";
        $u = "UPDATE userpost U, files F SET U.file_id = F.file_id WHERE U.user_id = '$id'";
        if (move_uploaded_file($_FILES["post_attachment"]["tmp_name"], $target_file)) {
            $db->query($i);
            $db->query($s);
            $db->query($u);
            var_dump("The file ". basename( $_FILES["post_attachment"]["name"]). " has been uploaded.");
        }
    }
}

/*
$target_dir = "pildid/upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 2000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		
		$file_display = array('jpg', 'jpeg', 'png', 'gif');

		if (file_exists($target_dir) == false) {
		echo 'Directory \''. $target_dir. '\' not found!';
		} else {
			$dir_contents = scandir($target_dir);
			foreach ($dir_contents as $file) {
			  $file_type = strtolower(end(explode('.', $file)));

				if ($file !== '.' && $file !== '..' && in_array($file_type, $file_display) == true){
					header("Location: profile.php");
				}
			}
		}
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
*/
?>