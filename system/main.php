<?
include('functions.php');

error_reporting(E_ALL);
date_default_timezone_set('Europe/Tallinn');

define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('EMAIL_ADDR', 'animeaddictscontinue@gmail.com');  // Sender email address
define('EMAIL_PW', 'Veebispetsialistid2014');

function set_base_url()
{
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

$url = ['index'];
if (isset($_SERVER['PATH_INFO'])) {
    $url = explode('/', $_SERVER['PATH_INFO']);
    array_shift($url);
}

//Session related code
session_start();
$user = &$_SESSION['user'];

//userpost
$u_id = $user['user_id'];

// Database related code
require __DIR__ . '/../config.php';
$db = new mysqli(DATABASE_HOSTNAME, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_DATABASE) or die(mysqli_connect_error());
mysqli_query($db, "SET NAMES utf8");
mysqli_query($db, "SET CHARACTER utf8");

$users = $db->query("SELECT * FROM user");

// Userpost related code
$u_post = $db->query("SELECT * FROM userpost U INNER JOIN files F ON U.file_id = F.file_id");
if ($u_post) $u_post->fetch_assoc();


/*
    if ($user) {

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


/*
if (isset($_SESSION['user'])) {
    $user = stripslashes($_SESSION['user']);
    $user_q = $db->query("SELECT * from user WHERE username='$user'");
    $user_d = $user_q->fetch_assoc();
}
*/