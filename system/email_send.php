<?
if (isset($_POST['from'])) {
    if (mailerSend('animeaddictscontinue@gmail.com', "$_POST[mailfrom]: $_POST[subject]", $_POST['message'])) {
        exit('Ok');
    }
}
?>