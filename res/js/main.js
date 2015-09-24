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
var xhr = function(u, p, c, t) {
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
    req.onreadystatechange = function() {
        if (req.readyState == 4 && req.status == 200) {
            c(req.response);
        }
    };
    if (t) {req.responseType = t;}
    req.send(par);
    return req;
}

function $(string) {
    return document.getElementById(string) || document.getElementsByTagName(string);
}

function login(base) {
    xhr(base + 'system/login.php', {un: $('username').value, pw: $('password').value}, function(result) {
        if (result == 'Ok') {
            window.location = window.location;
        } else {
            console.log(result);
        }
    });
}
function register(base, form) {
    xhr(base + 'system/register.php', {un: $('regUsername').value, pw: $('regPassword').value, cap: $('captcha').value}, function(result) {
        if (result == 'Ok') {
            window.location = window.location;
        } else {
            console.log(result);
        }
    });
}

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


//---------------------------- Initialization --------------------------------

window.onload = function(){

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
