<div class="contact">
    <h1>Contact</h1>
    <form action="" method="post">
        <label for="from">Your email address: </label><input id="from" class="br" type="text" name="from"
                                                             placeholder="example@example.com">
        <label for="subject">Subject: </label><input id="subject" class="br" type="text" name="subject"
                                                     placeholder="Subject...">
        <label for="message">Your message: </label><textarea id="message" class="br" name="message"
                                                             placeholder="Your message..."></textarea>
        <input name="mail" id="submit" type="submit" class="button">
    </form>
</div>

<script>
    _('submit').onclick = function () {
        xhr('system/email_send.php', {
            from: _('from').value,
            subject: _('subject').value,
            message: _('message').value
        }, function (result) {
            if (result == 'Ok') {
                alert('Email sent!');
                window.location = window.location.href.split('contact')[0];
            } else {
                console.log(result);
            }
        });
        return false;
    }
</script>