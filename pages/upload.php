<?
include("../system/main.php");

if (isset($_POST["newPost"])) {
    $target_dir = "uploads/files/";
    $user_id = $user['user_id'];
    $id = $db->real_escape_string($_POST['id']);
    $text = $db->real_escape_string($_POST['text']);
    if (basename($_FILES["post_attachment"]["name"]) == '') {
        $db->query("INSERT INTO userpost (user_id, text) VALUES ('$user_id', $text)");
        header("location: profile");
    } else {
        $target_file = $target_dir . basename($_FILES["post_attachment"]["name"]);
        // Check file size
        if ($_FILES["post_attachment"]["size"] > 838861000) {
            echo "Sorry, your file is too large.";
            exit("Sorry, your file is too large.");
        } elseif (file_exists($target_dir) == false) {
            echo "Directory \''. $target_dir. '\' not found!";
            exit('Directory \'' . $target_dir . '\' not found!');
        } else {
            if (move_uploaded_file($_FILES["post_attachment"]["tmp_name"], $target_file)) {
                $db->query("INSERT INTO files (file_name) VALUES ('$target_file')");
                $db->query("INSERT INTO userpost (user_id, text, file_id) VALUES ('$user_id', '$text', (SELECT file_id FROM files ORDER BY file_id DESC LIMIT 1))");
                header('location:profile');
            }
        }
    }
}

if (isset($_POST['disc_submit'])) {
    $target_dir = "uploads/files/";
    $title = $db->real_escape_string($_POST['title']);
    $text = $db->real_escape_string($_POST['text']);
    $user_id = $user['user_id'];
    if (basename($_FILES["disc_img"]["name"]) == '') {
        $db->query("INSERT INTO discussion (user_id, title, text) VALUES ('$user_id', '$title', '$text')");
        header('location: discussion');
    } else {
        $target_file = $target_dir . basename($_FILES["disc_img"]["name"]);
        $check = getimagesize($_FILES["disc_img"]["tmp_name"]);
        $imgType = pathinfo($target_file, PATHINFO_EXTENSION);
        if ($_FILES["disc_img"]["size"] > 5000000) {
            exit("Sorry, your file is too large.");
        } elseif (file_exists($target_dir) == false) {
            exit('Directory \'' . $target_dir . '\' not found!');
        } elseif ($check == false && $imgType != "jpg" && $imgType != "png" && $imgType != "jpeg"
            && $imgType != "gif"
        ) {
            exit('File is not an image file! ' . $check) . '. ' . $imgType . '.';
        } else {
            if (move_uploaded_file($_FILES["disc_img"]["tmp_name"], $target_file)) {
                $db->query("INSERT INTO files (file_name) VALUES ('$target_file')");
                $db->query("INSERT INTO discussion (user_id, title, text, file_id) VALUES ('$user_id', '$title', '$text', (SELECT file_id FROM files ORDER BY file_id DESC LIMIT 1))");
                header('location: discussion');
            } else {
                exit('Something went wrong: ' . $db->error);
            }
        }
    }
}

if (isset($_POST["user-update"])) {
    $username = $user["username"];
    $id = $_POST["id"];
    $l = $db->real_escape_string($_POST["location"]);
    $g = $_POST["gender"];
    $d = $_POST["day"];
    $m = $_POST["month"];
    $y = $_POST["year"];
    $date = $y . '-' . $m . '-' . $d;
    $bio = $db->real_escape_string($_POST["bio"]);

    if(!file_exists($_FILES['avatar']['tmp_name']) || !is_uploaded_file($_FILES['avatar']['tmp_name'])) {
        $sql = "UPDATE user SET location='$l', gender='$g', birthday = '$date', bio='$bio' WHERE user_id = '$id'";
        if ($db->query($sql)) {
            $result = $db->query("SELECT * FROM user WHERE user_id = '$id'");
            if ($result) {
                $_SESSION['user'] = $result->fetch_assoc();
                exit("Profile updated!");
            }
        } else {
            exit('Something went wrong! ' . $db->error);
        }
    }else{
        $target_dir = "../uploads/avatars/";
        $target_file = $target_dir . basename($_FILES["avatar"]["tmp_name"]);
        if (getimagesize($_FILES["avatar"]["tmp_name"]) === false) {
            exit("File is not an image.");
        }
        if ($_FILES["avatar"]["size"] > 2000000) {
            exit("Image is too large!");
        }
        $temp = explode(".", $_FILES["avatar"]["name"]);
        $file_path = $target_dir . $username . "_avatar" . '.' . end($temp);
        $target_path = "uploads/avatars/" . $username . "_avatar" . '.' . end($temp);
        foreach (glob($target_dir . $username . '_avatar.*') as $image) {
            unlink($image);
        }
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $file_path)) {
            $sql = "UPDATE user SET profile_image = '$target_path', location='$l', gender='$g', birthday = '$date', bio='$bio' WHERE user_id = '$id'";
            if ($db->query($sql)) {
                $result = $db->query("SELECT * FROM user WHERE user_id = '$id'");
                if ($result) {
                    $_SESSION['user'] = $result->fetch_assoc();
                    exit("Profile updated!");
                }
            } else {
                exit('Something went wrong! ' . $db->error);
            }
        }
    }
}

if (isset($_POST['discussion_comment'])) {
    $disc_id = $db->real_escape_string($_POST['discussion_id']);
    $user_id = $db->real_escape_string($_POST['user_id']);
    $comment = $db->real_escape_string($_POST['comment']);

    $sql = $db->query("INSERT INTO discussion_comments (discussion_id, user_id, text) VALUES ('$disc_id', '$user_id', '$comment')");
    if ($sql) {
        header('location: discussion');
    } else {
        exit($db->error);
    }
}
?>