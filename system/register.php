<? require_once('main.php');

if (isset($_POST['un'])) {
    $un = $db->real_escape_string($_POST['un']);
    $pw = $db->real_escape_string($_POST['pw']);
    $cap = strtoupper($_POST['cap']);
    if (empty($un) || empty($pw) || empty($cap)) {
        exit('Please fill all fields to continue.');
    } else if (strlen($un) > 20) {
        exit('Please user a shorter username to continue.');
    } else if (strlen($pw) < 6) {
        exit('Password needs to be at least 6 characters.');
    } else if ($cap != $_SESSION['cap']) {
        exit('Wrong captcha code! ' . $_SESSION['cap']);
    }
    $result = $db->query("SELECT * FROM user WHERE username = '$un'");
    if ($result->num_rows > 0) {
        exit('That username is taken!');
    }
    $result = $db->query("INSERT INTO user (username, password, ip_joined, ip_last) VALUES
                        ('$un', sha('$pw'), '{$_SERVER['REMOTE_ADDR']}', '{$_SERVER['REMOTE_ADDR']}')");
    if ($result) {
        $result = $db->query("SELECT * FROM user WHERE username = '$un'")->fetch_assoc();
        if ($result) {
            $db->query("UPDATE user SET online = '1' WHERE username='$un'");
            $_SESSION['user'] = $result;
            exit('1');
        } else {
            exit('Invalid Username or Password');
        }
    } else {
        exit('Mysql error: ' . $db->error);
    }
} else {
    exit('No data sent');
}