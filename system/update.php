<?
include("../system/main.php");

$id = $user['user_id'];
$username = $user['username'];

/* USER PASS UPDATE
** ========================================================================== */
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

/* USER EMAIL ADDRESS UPDATE
** ========================================================================== */
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
					$db->close();
	                echo "1";
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

if(isset($_POST['top-anime-selection'])) {
	if (!empty($id)) {
		$list = htmlspecialchars($db->real_escape_string($_POST['anime-selection-list']));
		$selection_id = $db->real_escape_string($_POST['selection_id']);

		$sql = $db->query("SELECT * FROM user_top_selection WHERE selection_id = '$selection_id' AND user_id = '$id'");
		if( mysqli_num_rows($sql) < 1 ) {
			$sql = $db->query("INSERT INTO user_top_selection (selection_id, user_id, anime_list) VALUES ('$selection_id', '$id', '$list')");
			if($sql) {
				$db->close();
				echo '1';
			} else {
				exit($db->error);
			}
		} else {
			$sql = $db->query("UPDATE user_top_selection SET anime_list = '$list' WHERE selection_id = '$selection_id' AND user_id = '$id'");
			if($sql) {
				$db->close();
				echo '1';
			} else {
				exit($db->error);
			}
		}
	}
}

/* USER UI CSS CODE UPDATE
** ========================================================================== */
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

/* USER UI VIEW UPDATE
** ========================================================================== */
if(isset($_POST['page-view-update'])) {
	if (!empty($id)) {
		$code = $db->real_escape_string($_POST['markup-editor']);
	
		$query = $db->query("SELECT * FROM view WHERE name = 'about_us'");
	    if (mysqli_num_rows($query) > 0) {
	    	$db->query("UPDATE view SET code = '$code' WHERE name = 'about_us'");
	    	echo '1';
	    	$db->close();
	    } else {
	    	$db->query("INSERT INTO view (name, code) VALUES ('about_us','$code') ");
	    	echo '1';
	    	$db->close();
	    }
    } else {
		exit('Please login first to continue.');
	}
}

/* USER UI BACKGROUND IMAGE UPDATE
** ========================================================================== */
if(isset($_POST['user-background-edit'])) {
	if (!empty($id)) {
		$image = isset($_FILES["user-background-image"]) ? $_FILES["user-background-image"] : "";
	
		$query = $db->query("SELECT * FROM user_code WHERE user_id = '$id'");
	    if (mysqli_num_rows($query) > 0) {
	    	$target_dir = "../avatars/files/";
	    	
	    	if(!empty($image['name'])) {
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
		    	foreach (glob($target_dir . $username . '_bg.*') as $p_image) {
	                unlink($p_image);
	            }
		    	$db->query("UPDATE user_code SET bg_img = '' WHERE user_id = '$id'");
		    	echo '1';
		    	$db->close();
		    }
	    } else {
	    	$target_dir = "../uploads/files/";
	    	
	    	if(!empty($image['name'])) {
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
		    } else {
		    	foreach (glob($target_dir . $username . '_bg.*') as $p_image) {
	                unlink($p_image);
	            }
		    	$db->query("INSERT INTO user_code (user_id, bg_img) VALUES ('$id','') ");
		    	echo '1';
		    	$db->close();
		    }
	    }
	} else {
		exit('Please login first to continue.');
	}
}

/* CREATE NEW USER POST
** ========================================================================== */
if (isset($_POST["newPost"])) {
    if(!empty($id)){
    	$text = $db->real_escape_string($_POST['text']);
    	$image = isset($_FILES["post_attachment"]) ? $_FILES["post_attachment"] : "";

    	if( empty($text) && empty($image) ) {
    		exit("Can't create an empty post.");
    	}

        if ( empty($image["name"])) {
            $db->query("INSERT INTO userpost (user_id, text) VALUES ('$id', '$text')");
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
                    $db->query("INSERT INTO userpost (user_id, text, file_name) VALUES ('$id', '$text', '$target_file')");
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

/* CREATE NEW DISCUSSION TOPIC
** ========================================================================== */
if (isset($_POST['new-discussion'])) {
    $title = $db->real_escape_string($_POST['title']);
    $text = $db->real_escape_string($_POST['text']);

    $image = isset($_FILES["new-discussion-image"]) ? $_FILES["new-discussion-image"] : "";

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
                $db->query("INSERT INTO discussion (user_id, title, text, file_name) VALUES ('$id', '$title', '$text', '$query_target')");
                echo "1";
                $db->close();
            } else {
                exit('Something went wrong: ' . $db->error);
            }
        }
    }
}

/* NEW EVENT PARTICIPANT
** ========================================================================== */
if (isset($_POST['new-participant'])) {
    $name = $db->real_escape_string($_POST['name']);
    $event_id = $db->real_escape_string($_POST['event_id']);

    $image = isset($_FILES["new-participant-work-image"]) ? $_FILES["new-participant-work-image"] : "";

    if( empty($image["name"]) ) {
        $db->query("INSERT INTO event_participant (user_id, event_id) VALUES ('$id', '$event_id')");
        echo "1";
        $db->close();
    } else {
        $target_dir = "../uploads/files/";
        $target_file = $target_dir . $image["name"];

        $check = getimagesize($image["tmp_name"]);
        $imgType = pathinfo($target_file, PATHINFO_EXTENSION);
        
        if ($image["size"] > 2000000) {
            exit("Sorry, your file is too large. Max image size is 2MB. *Tip for optimizing large image - <a class='warning-message-link' href='https://tinypng.com/' target='_blank'>https://tinypng.com/</a>");
        } elseif ($check == false && $imgType != "jpg" && $imgType != "png" && $imgType != "jpeg" && $imgType != "gif") {
            exit('File is not an image file! ' . $check) . '. ' . $imgType . '.';
        } else {
        	$temp = explode('.', $image['name']);
        	$newFileName = $target_dir . $name . '.' . end($temp);
            if (move_uploaded_file($image["tmp_name"], $newFileName)) {
                $query_target = "uploads/files/" . $name . '.' . end($temp);
                $db->query("INSERT INTO event_participants (user_id, event_id, file) VALUES ('$id', '$event_id', '$query_target')");
                echo "1";
                $db->close();
            } else {
                exit('Something went wrong: ' . $db->error);
            }
        }
    }
}

/* CREATE NEW DISCUSSION TOPIC
** ========================================================================== */
if (isset($_POST['new-event'])) {
    $title = $db->real_escape_string($_POST['title']);
    $text = $db->real_escape_string($_POST['text']);

    $image = isset($_FILES["new-event-image"]) ? $_FILES["new-event-image"] : "";

    if( empty($image["name"]) ) {
        $db->query("INSERT INTO events (name, description) VALUES ('$title', '$text')");
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
                $db->query("INSERT INTO events (name, description, image) VALUES ('$title', '$text', '$query_target')");
                echo "1";
                $db->close();
            } else {
                exit('Something went wrong: ' . $db->error);
            }
        }
    }
}

/* USER PROFILE UPDATE
** ========================================================================== */
if (isset($_POST["user-update"])) {
    $l = $db->real_escape_string($_POST["location"]);
    $g = $_POST["gender"];
    $d = $_POST["day"];
    $m = $_POST["month"];
    $y = $_POST["year"];
    $date = $y . '-' . (strlen($m) > 1 ? $m : '0'.$m) . '-' . (strlen($d) > 1 ? $d : '0'.$d);
    $bio = $db->real_escape_string($_POST["bio"]);

    $image = isset($_FILES['avatar']) ? $_FILES['avatar'] : "";

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

/* DELETE POST FROM DB
** ========================================================================== */
if(isset($_POST['postDelete'])) {
    $post_id = $db->real_escape_string($_POST['post_id']);
    $check = $db->query("SELECT post_id FROM userpost UP INNER JOIN user U ON U.user_id = UP.user_id WHERE post_id = '$post_id' AND username = '$username'");
    if ( mysqli_num_rows($check) > 0 ) {
        $db->query("DELETE FROM userpost WHERE post_id = '$post_id'");
        echo '1';
        $db->close();
    } else {
        echo 'Can not delete post.'. $db->error();
        $db->close();
    }
}

if(isset($_POST['about'])) {
	$username = $db->real_escape_string($_POST['username']);

	$sql = $db->query("SELECT * FROM user WHERE username = '$username' ");
	if(mysqli_num_rows($sql) > 0) {
		while($r = $sql->fetch_assoc()) {

			// explode the date to get month, day and year
			$birthDate = explode("-", $r['birthday']);
			// get age from date or birthdate
			$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md")
		    	? ((date("Y") - $birthDate[0]) - 1)
		    	: (date("Y") - $birthDate[0]));

			$monthNum  = strpos(explode('-', explode(' ', $r['date_joined'])[0])[1], '0') !== 0 
				? explode('-', explode(' ', $r['date_joined'])[0])[1] 
				: explode('0', explode('-', explode(' ', $r['date_joined'])[0])[1])[1];
			$dateObj   = DateTime::createFromFormat('!m', $monthNum);
			$month = $dateObj->format('F'); // March
			$day = strpos(explode('-', explode(' ', $r['date_joined'])[0])[2], '0') !== 0 
				? explode('-', explode(' ', $r['date_joined'])[0])[2] 
				: explode('0', explode('-', explode(' ', $r['date_joined'])[0])[2])[1];
			$year = explode('-', explode(' ', $r['date_joined'])[0])[0];

			$gender = substr($r['gender'], 0);
		?>
			<div class="user-about">
				<div class="user-header">
					<div class="user-header-avatar">
						<img class="user-image" src="<?=$r['profile_image']; ?>" onerror="this.onerror=null;this.src=&#34;uploads/avatars/default.jpg&#34;;">
						<span class="user-icon-helper"></span>
					</div>
					
					<div class="user-info-container">
						<h2 class="user-header-name"><?=$r['username']; ?></h2>
						<ul class="user-info-list">
							<?= !empty($r['location']) ? '<li class="user-info-item location"><i class="fa fa-home" aria-hidden="true"></i>'. $r['location'] .'</li>' : ''; ?>
							<li class="user-info-item joined"><i class="fa fa-calendar" aria-hidden="true"></i>Joined <?=$month .' '. $day.', '.$year; ?></li>
							<?= !empty($r['birthday']) ? '<li class="user-info-item age"><i class="fa fa-user" aria-hidden="true"></i>'. $age.'/'. $gender .'</li>' : ''; ?>
							<?= !empty($r['email']) ? '<li class="user-info-item email"><i class="fa fa-envelope-o" aria-hidden="true"></i>'. $r['email'] .'</li>' : ''; ?>
						</ul>
					</div>
				</div>

				<div class="user-description">
					<div class="user-bio">
						<?=$r['bio']; ?>
					</div>
				</div>
			</div>
		<? }
	} else {
		echo '0';
		$db->close();
	}
	
}

if(isset($_POST['photos'])) {
	$selected_user = $db->real_escape_string($_POST['username']);

	$sql = $db->query("SELECT UP.file_name, UP.post_date FROM userpost UP INNER JOIN user U ON UP.user_id = U.user_id WHERE U.username = '$selected_user' AND UP.file_name != ''");
	if(mysqli_num_rows($sql) > 0) {
		$monthNames = [
    		"January", "February", "March", 
    		"April", "May", "June", 
    		"July", "August", "September", 
    		"October", "November", "December"
		];
		
		while($r = $sql->fetch_assoc()) {
			$date = explode("-" ,explode(" ", $r["post_date"])[0])[2] . " " . $monthNames[explode("-" ,explode(" ", $r["post_date"])[0])[1] - 1] . " " . explode("-" ,explode(" ", $r["post_date"])[0])[0];
			?>

			<div class="user-photo-container">
				<img class="user-photo" src="<?=$r['file_name'];?>" alt="User post image" title="<?=$date;?>">
			</div>
		<? }
	} else {
		echo '<h3>There are currently no photos uploaded by this user.</h3>';
	}
}
?>