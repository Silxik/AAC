<?
session_start();

// Creates a new captcha code and stores it in session
$crs = preg_split('//', 'ABCEFGHIJKLMNPRSTUVWXYZ123456789', 0, PREG_SPLIT_NO_EMPTY);
shuffle($crs);
$_SESSION['cap'] = substr(implode("", $crs), 3, 4);

// Allocates images and colors
$im = imagecreate(192, 90);
$im2 = imagecreate(192, 90);
$im3 = imagecreate(220, 30);
$bg = imagecolorallocate($im, 0, 0, 0);
$tc = imagecolorallocate($im, rand(100, 255), rand(100, 255), rand(100, 255));

// Generates the text
imagestring($im, 4, 0, -1, $_SESSION['cap'], $tc);
imagecopyresized($im2, $im, 0, 0, 0, 0, 192, 90, 32, 15);

// Applies vertical distortion
$f = 1 / rand(20, 60);      // Frequency
$d = rand(0, 180);          // Displacement
$a = rand(4, 9);            // Amplitude
for ($x = 0; $x < 192; $x++) {
    imagecopy($im, $im2, $x, 0, $x, $a * sin(($d + $x) * $f), 1, 90);
}

// Applies horisontal distortion
$f = 1 / rand(15, 20);
$d = rand(0, 180);
$a = rand(4, 9);
for ($y = 0; $y < 90; $y++) {
    imagecopy($im2, $im, 0, $y, $a * sin(($d + $y) * $f), $y, 192, 1);
}

// Applies rotation
$im = imagerotate($im2, (500 - rand(0, 1000)) * 0.01, $bg);

// Resizes to output
imagecopyresized($im3, $im, 60, 0, 0, 0, 100, 30, 192, 90);

// Outputs the image
header('Content-type: image/jpeg');
imagejpeg($im3, null, 70);

// Clears memory
imagedestroy($im);
imagedestroy($im2);
imagedestroy($im3);
?>