<?

define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('EMAIL_ADDR', 'animeaddictscontinue@gmail.com');  // Sender email address
define('EMAIL_PW', 'Veebispetsialistid2014');

function mailerSend($email, $subject, $body, $filename = 0)
{
    require 'PHPMailerAutoload.php';

    $mailer = new PHPMailer();
    //SMTP Configuration
    $mailer->isSMTP();
    $mailer->CharSet = 'UTF-8';
    $mailer->SMTPAuth = true; //We need to authenticate
    $mailer->Host = SMTP_HOST;
    $mailer->Port = SMTP_PORT;
    $mailer->Username = EMAIL_ADDR;
    $mailer->Password = EMAIL_PW;
    $mailer->SMTPSecure = 'TLS';        //SSL or TLS
    //From - To:
    $mailer->From = EMAIL_ADDR;
    //$mailer->FromName = 'MediMatkat OÜ'; //Optional
    $mailer->addAddress($email);  // Add a recipient

    //Subject - Body :
    $mailer->Subject = $subject;
    $mailer->Body = $body;
    $mailer->isHTML(false);      //Mail body contains HTML tags
    if ($filename) $mailer->addAttachment($filename, 'invoice.pdf');
    //Check if mail is sent :
    if (!$mailer->send()) {
        exit('Error sending mail : ' . $mailer->ErrorInfo);
    } else {
        exit('Email sent!');
    }
}

mailerSend('animeaddictscontinue@gmail.com', 'phpmailer test', 'mail body');