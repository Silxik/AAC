<?
include('functions.php');

error_reporting(E_ALL);
date_default_timezone_set('Europe/Tallinn');

// REDIRECT TO HTTPS IF SSL ON
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

// DB LINK, CONNECT
require __DIR__ . '/../config.php';
$db = new mysqli(DATABASE_HOSTNAME, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_DATABASE) or die(mysqli_connect_error());
mysqli_query($db, "SET NAMES utf8");
mysqli_query($db, "SET CHARACTER utf8");

$users = $db->query("SELECT * FROM user");