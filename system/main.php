<?php

function set_base_url() {
    $s = &$_SERVER;
    $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true : false;
    $sp = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
    $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : $s['SERVER_NAME'];
    $uri = $protocol . '://' . $host . $port . dirname($_SERVER['SCRIPT_NAME']);
    define('BASE_URL', rtrim($uri, '/') . '/');
}

error_reporting(E_ALL);
ini_set('display_errors', 'on');
set_base_url();


if (isset($_SERVER['PATH_INFO'])) {
    if ($path_info = explode('/', $_SERVER['PATH_INFO'])) {
        array_shift($path_info);
        $controller = isset($path_info[0]) ? array_shift($path_info) : 'index';
        $action = isset($path_info[0]) && !empty($path_info[0]) ? array_shift($path_info) : 'index';
        $params = isset($path_info[0]) ? $path_info : array();
    }
}

//Session related code
session_start();
$loggedIn = isset($_SESSION['user']);
$user = stripslashes($_SESSION['user']);
/*
    if ($loggedIn) {

        $inactive = 600;
        if (!isset($_SESSION['timeout']))
            $_SESSION['timeout'] = time() + $inactive;
        $session_life = time() - $_SESSION['timeout'];
        if ($session_life > $inactive) {
            $conn->query("UPDATE user SET log = 'out' WHERE username='$login_session'");
            session_destroy();
            header("Location: index.php");
        }
        $_SESSION['timeout'] = time();

    }
*/
//Database related code
$db = new mysqli("localhost", "root", "", "aac") or die(mysqli_connect_error());
mysqli_query($db, "SET NAMES utf8");
mysqli_query($db, "SET CHARACTER utf8");

//User related code
$user_q = $db->query("SELECT * from user WHERE username='$user'");
$user_d = $user_q->fetch_assoc();
?>