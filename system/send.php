<?
// PHPMailer con.
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('EMAIL_ADDR', 'animeaddictscontinue@gmail.com');
define('EMAIL_PW', 'Veebispetsialistid2014');

$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

require 'PHPMailerAutoload.php';

$mailer = new PHPMailer();

//SMTP Configuration
$mailer->isSMTP();

$mailer->CharSet = 'UTF-8';
$mailer->SMTPAuth = true;

$mailer->Host = SMTP_HOST;
$mailer->Port = SMTP_PORT;
$mailer->Username = EMAIL_ADDR;
$mailer->Password = EMAIL_PW;
$mailer->SMTPSecure = 'TLS';        //SSL or TLS

//From - To:
$mailer->From = EMAIL_ADDR;

$mailer->addAddress(EMAIL_ADDR);  // Add a recipient
$mailer->addAddress($email);
$mailer->Subject = $subject;
$mailer->Body = $message;

//Check if mail is sent :
if (!$mailer->send()) {
    echo 'Error sending mail : ' . $mailer->ErrorInfo;
} else {
    echo 'Email sent!';
}