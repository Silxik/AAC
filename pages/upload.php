<?
if(isset($_POST["newPost"])) {
    $target_dir = "uploads/files/";
    $user_id = $user['user_id'];
    $id = $db->real_escape_string($_POST['id']);
    $text = $db->real_escape_string($_POST['text']);
    if(basename($_FILES["post_attachment"]["name"]) == ''){
        $db->query("INSERT INTO userpost (user_id, text) VALUES ('$user_id', $text)");
        header("location: profile");
    }
    else{
        $target_file = $target_dir . basename($_FILES["post_attachment"]["name"]);
        // Check file size
        if($_FILES["post_attachment"]["size"] > 83886100) {
            echo "Sorry, your file is too large.";
            exit("Sorry, your file is too large.");
        }
        elseif (file_exists($target_dir) == false) {
            echo "Directory \''. $target_dir. '\' not found!";
            exit('Directory \''. $target_dir. '\' not found!');
        } else {
            if (move_uploaded_file($_FILES["post_attachment"]["tmp_name"], $target_file)) {
                $db->query("INSERT INTO files (file_name) VALUES ('$target_file')");
                $db->query("INSERT INTO userpost (user_id, text, file_id) VALUES ('$user_id', '$text', (SELECT file_id FROM files ORDER BY file_id DESC LIMIT 1))");
                header('location:profile');
            }
        }
    }
}

if(isset($_POST['disc_submit'])){
    $target_dir = "uploads/files/";
    $title = $db->real_escape_string($_POST['title']);
    $text = $db->real_escape_string($_POST['text']);
    $user_id = $user['user_id'];
    if(basename($_FILES["disc_img"]["name"]) == ''){
        $db->query("INSERT INTO discussion (user_id, title, text) VALUES ('$user_id', '$title', '$text')");
        header('location: discussion');
    }
    else{
        $target_file = $target_dir . basename($_FILES["disc_img"]["name"]);
        $check = getimagesize($_FILES["disc_img"]["tmp_name"]);
        $imgType = pathinfo($target_file,PATHINFO_EXTENSION);
        if($_FILES["disc_img"]["size"] > 5000000) {
            exit("Sorry, your file is too large.");
        }
        elseif (file_exists($target_dir) == false) {
            exit('Directory \''. $target_dir. '\' not found!');
        }
        elseif($check == false && $imgType != "jpg" && $imgType != "png" && $imgType != "jpeg"
            && $imgType != "gif") {
            exit('File is not an image file! ' . $check) . '. ' . $imgType . '.';
        }else{
            if (move_uploaded_file($_FILES["disc_img"]["tmp_name"], $target_file)) {
                $db->query("INSERT INTO files (file_name) VALUES ('$target_file')");
                $db->query("INSERT INTO discussion (user_id, title, text, file_id) VALUES ('$user_id', '$title', '$text', (SELECT file_id FROM files ORDER BY file_id DESC LIMIT 1))");
                header('location: discussion');
            }else{
                exit('Something went wrong: '. $db->error);
            }
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