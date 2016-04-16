function login() {
    var un = $("#username").val();
    var pw = $("#password").val();
    $.ajax({
        url:"system/login.php",
        data: {un:un, pw:pw},
        type:"post",
        success:function(){
            window.location = window.location;
        },
        error:function(result){
            console.log(result);
        }
    });
}

function register() {
    var un = $("#regUsername").val();
    var pw = $("#regPassword").val();
    var cap = $("#captcha").val();
    $.ajax({
        url:"system/register.php",
        data: {un:un, pw:pw, cap:cap},
        type:"post",
        success:function(){
            window.location = window.location.href.split('register')[0];
        },
        error:function(result){
            console.log(result);
        }
    });
}

function sendEmail() {
    var email = $("#from").val();
    var subject = $("#subject").val();
    var message = $("#message").val();
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (!email || !subject || !message) {
        $("#mail-error").html("<h2>All fields must be filled!</h2>");
    } else if (email == '' || !re.test(email)) {
        $("#mail-error").html("<h2>Please enter a valid email address.</h2>");
    } else {
        $.ajax({
            url: "system/send.php",
            data: $("#contact-form").serialize(),
            type: "POST",
            success: function () {
                $("#contact-form").html("<h2>Thank you! Your mail has been sent!</h2><p>" + email + "</p><p>" + subject + "</p><p>" + message + "</p>");
            }
        });
    }
}

function updatePass(formData){
    var curPass = formData.find(".curPass").val();
    var newPass = formData.find(".newPass").val();
    var confirm = formData.find(".confirm").val();

    if ( curPass == ""){
        $(".errorlog").html("<h3 class='error-header'>You must input your current password to continue.</h3>");
    } else if ( newPass == "" ) {
        $(".errorlog").html("<h3 class='error-header'>You must input your new password to continue.</h3>");
    } else if ( newPass != confirm ) {
        $(".errorlog").html("<h3 class='error-header'>Passwords don't match!</h3>");
    } else {
        $.ajax({
            url: "system/update.php",
            data: $("#pass-update").serialize(),
            type: "POST",
            success: function(data){
                $(".errorlog").html(data);
                formData.find(".curPass").val('');
                formData.find(".newPass").val('');
                formData.find(".confirm").val('');
            }
        });
    }
}

function updateMail(formData){
    var curPass = formData.find(".curPass").val();
    var newMail = formData.find(".newMail").val();
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if ( curPass == "" ){
        $(".errorlog").html("<h3 class='error-header'>You must input your current password to change your email address.</h3>");
    } else if ( newMail == '' || !re.test(newMail) ) {
        $(".errorlog").html("<h3 class='error-header'>You must input your new valid email to continue.</h3>");
    } else {
        $.ajax({
            url: "system/update.php",
            data: $("#mail-update").serialize(),
            type: "POST",
            success: function(data){
                $(".errorlog").html(data);
                formData.find(".curPass").val('');
                formData.find(".newMail").val('');
            }
        });
    }
}

$(document).ready(function () {
    /* Upload avatar image preview for profileEdit */
    var preview = $(".image-preview");
    $("#file").change(function (e) {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            preview.attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });

    // Login and register on enter keypress
    $('#loginForm').keydown(function(e) {
        if (e.which == 13) {    // Enter key
            login();
        }
    });

    $('#registerForm').keydown(function(e){
        if ( e.which == 13 ){
            register();
        }
    });

    $('.discussion-title').click(function () {
        var id = $(this).data('id');
        $.get({
            url: 'system/ajax_discussion.php',
            data: {id: id},
            success: function (data) {
                $('.discussion-block').html(data);
                window.location.search = "id="+ id;
            }
        });
    });

    $('#contact-form, #userForm').submit(function () {
        return false;
    });

    // Passes username to a hidden form & submits
    $(document).on('click', '.user-link',function(){
        var userlink = $(this).text();
        $('#u-link-name').val(userlink);
        $('#u-link-fetch input[type="submit"]').click();
    }).on('click', '.admin-nav-link', function(){
        $(this).parent().children('.admin-editable').addClass('active');
        $('.admin-nav-link').addClass('hidden');
    });

    // User data update
    $(document).on('submit', '#userForm', function(){
        var formData = new FormData(this);
        $.ajax({
            url: 'pages/upload.php',
            type: 'POST',
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            data: formData,
            success: function (data) {
                $('#user-error').html(data);
                window.location = window.location;
            }
        });
        return false;
    });

    $(document).on('submit', '#pass-update', function(e){
        updatePass( $(this) );
        e.preventDefault();
    });

    $(document).on('submit', '#mail-update', function(e){
        updateMail( $(this) );
        e.preventDefault();
    });
});

/*
 $('#html_editor').keyup(function(){
 document.getElementById("html_text").innerHTML= $('textarea').val();
 });

 // textarea tab override for space
 $(document).delegate('#html_editor', 'keydown', function(e) {
 var keyCode = e.keyCode || e.which;

 if (keyCode == 9) {
 e.preventDefault();
 var start = $(this).get(0).selectionStart;
 var end = $(this).get(0).selectionEnd;

 // set textarea value to: text before caret + tab + text after caret
 $(this).val($(this).val().substring(0, start)
 + "\t"
 + $(this).val().substring(end));

 // put caret at right position again
 $(this).get(0).selectionStart =
 $(this).get(0).selectionEnd = start + 1;
 }
 });
*/