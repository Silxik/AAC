<div class="contact-block">
    <h1 class="header-h1">Contact</h1>
    <form action="" target="_self" method="" id="contact-form">
        <label class="form-label" for="from">Your email address: </label>
        <input id="from" class="br" type="text" name="from" placeholder="example@example.com">
        <label class="form-label" for="subject">Subject: </label>
        <input id="subject" class="br" type="text" name="subject" placeholder="Subject...">
        <label class="form-label" for="message">Your message: </label>
        <textarea id="message" class="br" name="message" placeholder="Your message..."></textarea>
        <button id="send-mail" class="button" type="submit" onclick="sendEmail()">Submit</button>
    </form>
    <div id="mail-error"></div>
</div>