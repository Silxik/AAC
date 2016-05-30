<div id="mail-error"></div>
<div class="contact-block">
    <h1 class="header-h1">Contact</h1>
    <form action="system/send.php" target="_self" method="post" id="contact-form">
        
        <div>
            <label class="form-label in-line" for="from">Email: </label>
            <input id="from" class="br" type="text" name="from" placeholder="example@example.com" <?= !empty($user['email']) ? "value='".$user['email']."'" : '';?> >
        </div>

        <div>
            <label class="form-label in-line" for="subject">Subject: </label>
            <input id="subject" class="br" type="text" name="subject" placeholder="Subject...">
        </div>

        <div>
            <label class="form-label in-line text-area-label" for="message">Your message: </label>
            <textarea id="message" class="text-area" name="message" placeholder="Your message..."></textarea>
        </div>

        <div>
            <label class="form-label in-line"></label><button id="send-mail" class="button" type="submit" onclick="sendEmail()">Send</button>
        </div>

    </form>
</div>