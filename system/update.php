<?
include("../system/main.php");

$id = $user['user_id'];
$username = $user['username'];

if(isset($_POST['passUpdate'])) {
	if (!empty($id)) {
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
					echo "1";
					$db->close();
	            }
			} else {
				exit($db->error);
			}
		} else {
			exit("Incorrect current password.");
		}
	} else {
		exit('Please login first to continue.');
	}
}

if(isset($_POST['mailUpdate'])) {
	if (!empty($id)) {
		$curPass = $db->real_escape_string($_POST['curPass']);
		$newMail = $db->real_escape_string($_POST['newMail']);
	
		$query = $db->query("SELECT username FROM user WHERE user_id=$id AND password=sha('$curPass')");
	
		if(mysqli_num_rows($query) > 0){
			$query = $db->query("UPDATE user SET email = '$newMail' WHERE user_id = $id");
	
			if($query){
				$result = $db->query("SELECT * FROM user WHERE user_id = '$id'");
	            if ($result) {
	                $_SESSION['user'] = $result->fetch_assoc();
	                echo "1";
					$db->close();
	            }
			} else {
				exit($db->error);
			}
		} else {
			exit("Incorrect current password.");
		}
	} else {
		exit('Please login first to continue.');
	}
}

if(isset($_POST['admin-editor-submit'])) {
	if (!empty($id)) {
		$code = $db->real_escape_string(strip_tags($_POST['admin-style-editor']));
	
		$query = $db->query("SELECT * FROM user_code WHERE user_id = '$id'");
	    if (mysqli_num_rows($query) > 0) {
	    	$db->query("UPDATE user_code SET css_editor = '$code' WHERE user_id = '$id'");
	    	echo '1';
	    	$db->close();
	    } else {
	    	$db->query("INSERT INTO user_code (user_id, css_editor) VALUES ('$id','$code') ");
	    	echo '1';
	    	$db->close();
	    }
    } else {
		exit('Please login first to continue.');
	}
}

if(isset($_POST['user-background-edit'])) {
	if (!empty($id)) {
		$image = $_FILES["user-background-image"];
	
		$query = $db->query("SELECT * FROM user_code WHERE user_id = '$id'");
	    if (mysqli_num_rows($query) > 0) {
	    	$target_dir = "../avatars/files/";
	        $target_file = $target_dir . $image["name"];
	
	        $check = getimagesize($image["tmp_name"]);
	        $imgType = pathinfo($target_file, PATHINFO_EXTENSION);
	
	        if ($image["size"] > 1000000) {
	            exit("Sorry, your file is too large. Max image size is 1MB. *Tip for optimizing large image - <a class='warning-message-link' href='https://tinypng.com/' target='_blank'>https://tinypng.com/</a>");
	        } elseif ($check == false && $imgType != "jpg" && $imgType != "png" && $imgType != "jpeg" && $imgType != "gif") {
	            exit('File is not an image file! ' . $check) . '. ' . $imgType . '.';
	        } else {
	        	$temp = explode(".", $image["name"]);
	            $file_path = $target_dir . $username . "_bg" . '.' . end($temp);

	            $query = $db->query("SELECT * FROM user_code WHERE user_id = '$id'");
	            $result = $query->fetch_assoc();
	            $version = strrchr($result['bg_img'], '?') === false ? '?1' : '?'.(explode('?', $result['bg_img'])[1] + 1);

	            $target_path = "uploads/avatars/" . $username . "_bg" . '.' . end($temp);
	            $new_file_target_file = "../". $target_path;
	            foreach (glob($target_dir . $username . '_bg.*') as $p_image) {
	                unlink($p_image);
	            }

	            if (move_uploaded_file($image["tmp_name"], $new_file_target_file)) {
	            	$target_path = "uploads/avatars/" . $username . "_bg" . '.' . end($temp).$version;
	                $db->query("UPDATE user_code SET bg_img = '$target_path' WHERE user_id = '$id'");
			    	echo '1';
			    	$db->close();
	            } else {
	                exit('Something went wrong: ' . $db->error);
	            }
	        }
	    } else {
	    	$target_dir = "../uploads/files/";
	        $target_file = $target_dir . $image["name"];
	
	        $check = getimagesize($image["tmp_name"]);
	        $imgType = pathinfo($target_file, PATHINFO_EXTENSION);
	
	        if ($image["size"] > 1000000) {
	            exit("Sorry, your file is too large. Max image size is 1MB. *Tip for optimizing large image - <a class='warning-message-link' href='https://tinypng.com/' target='_blank'>https://tinypng.com/</a>");
	        } elseif ($check == false && $imgType != "jpg" && $imgType != "png" && $imgType != "jpeg" && $imgType != "gif") {
	            exit('File is not an image file! ' . $check) . '. ' . $imgType . '.';
	        } else {
	        	$temp = explode(".", $image["name"]);
	            $file_path = $target_dir . $username . "_bg" . '.' . end($temp);
	            $target_path = "uploads/avatars/" . $username . "_bg" . '.' . end($temp);
	            $new_file_target_file = "../". $target_path;
	            foreach (glob($target_dir . $username . '_bg.*') as $p_image) {
	                unlink($p_image);
	            }

	            if (move_uploaded_file($image["tmp_name"], $new_file_target_file)) {
	                $db->query("INSERT INTO user_code (user_id, bg_img) VALUES ('$id','$target_path') ");
			    	echo '1';
			    	$db->close();
	            } else {
	                exit('Something went wrong: ' . $db->error);
	            }
	        }
	    }
	} else {
		exit('Please login first to continue.');
	}
}

if (isset($_POST["newPost"])) {
    if(!empty($id)){
    	$text = $db->real_escape_string($_POST['text']);
    	$image = $_FILES["post_attachment"];

        if ( empty($image["name"])) {
            $db->query("INSERT INTO userpost (user_id, text, file_id) VALUES ('$id', '$text', '0')");
            echo "1";
            $db->close();
        } else {

        	$target_dir = "../uploads/files/";
            $target_file = $target_dir . $image["name"];

    	    $check = getimagesize($image["tmp_name"]);
    	    $imgType = pathinfo($target_file, PATHINFO_EXTENSION);
    
            // Check file size
            if ( $image["size"] > 1000000 ) {
                exit("Sorry, your file is too large. Max image size is 1MB. *Tip for optimizing large image - <a class='warning-message-link' href='https://tinypng.com/' target='_blank'>https://tinypng.com/</a>");
            } elseif ($check == false && $imgType != "jpg" && $imgType != "png" && $imgType != "jpeg" && $imgType != "gif") {
                exit('File is not an image file! ' . $check) . '. ' . $imgType . '.';
            } else {
                if (move_uploaded_file($image["tmp_name"], $target_file)) {
                	$target_file = "uploads/files/" . $image['name'];
                    $db->query("INSERT INTO files (file_name) VALUES ('$target_file')");
                    $db->query("INSERT INTO userpost (user_id, text, file_id) VALUES ('$id', '$text', (SELECT file_id FROM files ORDER BY file_id DESC LIMIT 1))");
                    echo "1";
                    $db->close();
                } else {
                	exit('Something went wrong: ' . $db->error);
                }
            }
        }
    } else {
    	exit('Please login first to continue.');
    }
}

if (isset($_POST['new-discussion'])) {
    $title = $db->real_escape_string($_POST['title']);
    $text = $db->real_escape_string($_POST['text']);

    $image = $_FILES["new-discussion-image"];

    if( empty($image["name"]) ) {
        $db->query("INSERT INTO discussion (user_id, title, text) VALUES ('$id', '$title', '$text')");
        echo "1";
        $db->close();
    } else {
        $target_dir = "../uploads/files/";
        $target_file = $target_dir . $image["name"];

        $check = getimagesize($image["tmp_name"]);
        $imgType = pathinfo($target_file, PATHINFO_EXTENSION);
        
        if ($image["size"] > 1000000) {
            exit("Sorry, your file is too large. Max image size is 1MB. *Tip for optimizing large image - <a class='warning-message-link' href='https://tinypng.com/' target='_blank'>https://tinypng.com/</a>");
        } elseif ($check == false && $imgType != "jpg" && $imgType != "png" && $imgType != "jpeg" && $imgType != "gif") {
            exit('File is not an image file! ' . $check) . '. ' . $imgType . '.';
        } else {
            if (move_uploaded_file($image["tmp_name"], $target_file)) {
                $query_target = "uploads/files/". $image["name"];
                $db->query("INSERT INTO files (file_name) VALUES ('$query_target')");
                $db->query("INSERT INTO discussion (user_id, title, text, file_id) VALUES ('$id', '$title', '$text', (SELECT file_id FROM files ORDER BY file_id DESC LIMIT 1))");
                echo "1";
                $db->close();
            } else {
                exit('Something went wrong: ' . $db->error);
            }
        }
    }
}

if (isset($_POST["user-update"])) {
    $l = $db->real_escape_string($_POST["location"]);
    $g = $_POST["gender"];
    $d = $_POST["day"];
    $m = $_POST["month"];
    $y = $_POST["year"];
    $date = $y . '-' . (strlen($m) > 1 ? $m : '0'.$m) . '-' . (strlen($d) > 1 ? $d : '0'.$d);
    $bio = $db->real_escape_string($_POST["bio"]);

    $image = $_FILES['avatar'];

    if( empty($image["name"]) ) {
        $query = $db->query("UPDATE user SET location='$l', gender='$g', birthday = '$date', bio='$bio' WHERE user_id = '$id'");
        if ( $query ) {
            $query = $db->query("SELECT * FROM user WHERE user_id = '$id'");
            if ( $query ) {
                $_SESSION['user'] = $query->fetch_assoc();
                echo "1";
                $db->close();
            }
        }else {
            exit('Something went wrong! ' . $db->error);
        }
    } else {
        $target_dir = "../uploads/avatars/";
        $target_file = $target_dir . $image["name"];

        $check = getimagesize($image["tmp_name"]);
        $imgType = pathinfo($target_file, PATHINFO_EXTENSION);
        
        if ($image["size"] > 1000000) {
            exit("Sorry, your file is too large. Max image size is 1MB. *Tip for optimizing large image - <a class='warning-message-link' href='https://tinypng.com/' target='_blank'>https://tinypng.com/</a>");
        } elseif ($check == false && $imgType != "jpg" && $imgType != "png" && $imgType != "jpeg" && $imgType != "gif") {
            exit('File is not an image file! ' . $check) . '. ' . $imgType . '.';
        } else {

            $temp = explode(".", $image["name"]);
            $file_path = $target_dir . $username . "_avatar" . '.' . end($temp);
            $target_path = "uploads/avatars/" . $username . "_avatar" . '.' . end($temp);
            $new_file_target_file = "../". $target_path;
            foreach (glob($target_dir . $username . '_avatar.*') as $p_image) {
                unlink($p_image);
            }

            if (move_uploaded_file($image["tmp_name"], $new_file_target_file)) {
                $query_target = "uploads/avatars/". $image["name"];
                $query = $db->query("UPDATE user SET profile_image = '$target_path', location='$l', gender='$g', birthday = '$date', bio='$bio' WHERE user_id = '$id'");
                if ($query) {
                    $query = $db->query("SELECT * FROM user WHERE user_id = '$id'");
                    if ($query) {
                        $_SESSION['user'] = $query->fetch_assoc();
                        echo "1";
                        $db->close();
                    }
                }
            } else {
                exit('Something went wrong: ' . $db->error);
            }
        }
    }
}

if (isset($_POST['discussion_comment'])) {
    $disc_id = $db->real_escape_string($_POST['discussion_id']);
    $comment = $db->real_escape_string($_POST['comment']);

    $sql = $db->query("INSERT INTO discussion_comments (discussion_id, user_id, text) VALUES ('$disc_id', '$id', '$comment')");
    if ($sql) {
        $db->close();
        header('location: discussion');
    } else {
        exit($db->error);
    }
}
?>