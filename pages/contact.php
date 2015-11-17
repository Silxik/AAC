<div class="contact">
    <h1>Contact</h1>
    <form action="" method="post">
        <label for="mailfrom">Your email address: </label><input class="br" type="text" name="mailfrom" placeholder="example@example.com">
        <label for="subject">Subject: </label><input class="br" type="text" name="subject" placeholder="Subject...">
        <label for="message">Your message: </label><textarea class="br" name="message" placeholder="Your message..."></textarea>
        <input name="mail" type="submit" class="button">
    </form>
</div>

<?
if(isset($_POST['mail'])){
    $mailfrom = $_POST['mailfrom'];
    $mailto = 'andresspak@gmail.com';

    $subject = $_POST['subject'];
    $message = $_POST['message'];
    mail($mailto,$subject,$message);
}
?>