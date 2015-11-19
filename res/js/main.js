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
    console.log(_('username'));
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

/* Upload avatar image preview for profileEdit */
document.onready = function(){
    var preview = document.getElementById("prev");
    _("file").onchange = function(e){
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function(e){
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

window.onload = function () {

    _('loginForm').onkeydown = function (e) {
        if (e.which == 13) {    // Enter key
            login();
        }
    }
    _('registerForm').onkeydown = function (e) {
        if (e.which == 13) {    // Enter key
            register();
        }
    }
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
}