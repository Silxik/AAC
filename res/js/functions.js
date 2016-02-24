//---------------------------- Functions --------------------------------

/**
 * Sends an XMLHttpRequest to a url and returns the response
 * to the callback function once it arrives
 * @param {string} u Target url
 * @param {Object} p Parameters as JSON object
 * @param {function} c Callback function
 * @param {string=} t Response type (optional)
 * @return {object} XMLHttpRequest object
 */
var xhr = function (u, p, c, t) {
    /**
     * @type {XMLHttpRequest} r XMLHttpRequest object
     */
    var req = new XMLHttpRequest(),
        par = '';
    // Generate request body from params
    for (var key in p) {
        par += par != '' ? '&' : '';
        par += key + "=" + encodeURIComponent(p[key]);
    }
    req.open('POST', u, true);

    req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    req.setRequestHeader("Content-length", par.length);
    req.setRequestHeader("Connection", "close");
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            c(req.response);
        }
    };
    if (t) {
        req.responseType = t;
    }
    req.send(par);
    return req;
}

function _(string) {
    return document.getElementById(string) || document.getElementsByClassName(string) || document.getElementsByTagName(string);
}

function login() {
    xhr('system/login.php', {un: _('username').value, pw: _('password').value}, function (result) {
        if (result == 'Ok') {
            window.location = window.location;
        } else {
            console.log(result);
        }
    });
}

function register() {
    xhr('system/register.php', {
        un: _('regUsername').value,
        pw: _('regPassword').value,
        cap: _('captcha').value
    }, function (result) {
        if (result == 'Ok') {
            window.location = window.location.href.split('register')[0];
        } else {
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

document.onready = function () {
    /* Upload avatar image preview for profileEdit */

    var preview = document.getElementById("image-preview");
    _("file").onchange = function (e) {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            image_base64 = e.target.result;
            preview.src = image_base64;
        };
        reader.readAsDataURL(file);
    };
};
/*

 http://stackoverflow.com/questions/824349/modify-the-url-without-reloading-the-page

 function processAjaxData(response, urlPath){
 document.getElementById("content").innerHTML = response.html;
 document.title = response.pageTitle;
 window.history.pushState({"html":response.html,"pageTitle":response.pageTitle},"", urlPath);
 }

 window.onpopstate = function(e){
 if(e.state){
 document.getElementById("content").innerHTML = e.state.html;
 document.title = e.state.pageTitle;
 }
 };

 */

//----------------------------Global variables---------------------------
//var BASE_URL = 'localhost/AAC/';


//---------------------------- Initialization --------------------------------

$(document).ready(function () {
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
        var discussion_name = $(this).text();
        var username = $('.user-link').eq($(this).parent().parent().parent().index()).text();
        $.ajax({
            url: 'system/ajax_discussion.php',
            data: {username: username, discussion_name: discussion_name},
            type: 'POST',
            success: function (data) {
                $('.discussion-block').html(data);
            }
        });
    });

    $('#contact-form').submit(function () {
        return false;
    });

    $(".user-link").click(function(){
        var userlink = $(this).text();
        $("#u-link-name").val(userlink);
        $("#u-link-fetch input[type='submit']").click();
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

 $('#EditorToggler').click(function(){
 $('#WebEditor').animate({
 width: 'toggle'
 });
 });

 $('#profile').click(function(){
 $('#iconUpload').toggle();
 });
 */