<? require_once('main.php');
if (isset($_POST['un'])) {
    $un = $db->real_escape_string($_POST['un']);
    $pw = $db->real_escape_string($_POST['pw']);
    if (empty($un) || empty($pw)) {
        exit('Username or Password is missing!');
    } else {
        $result = $db->query("SELECT * FROM user WHERE password = sha('$pw') AND username = '$un'");
        if (mysqli_num_rows($result) > 0) {
            $result = $result->fetch_assoc();
            $db->query("UPDATE user SET online = '1' WHERE username='$un'");
            $_SESSION['user'] = $result;
            foreach ($result as $i => &$v) {
                $v = stripslashes($v);
            }
            echo "1";
            $db->close();
        } else {
            echo "Invalid Username or Password";
            $db->close();
        }
    }
} else {
    exit('No data sent');
}