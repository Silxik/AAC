//---------------------------- Functions --------------------------------

/**
 * Sends an XMLHttpRequest to a url and returns the response
 * to the callback function once it arrives
 * @param {string} u Target url
 * @param {function} c Callback function
 * @param {string=} t Response type
 * @return {object} XMLHttpRequest object
 */
var xhr = function(u, c, t) {
    /**
     * @type {XMLHttpRequest} r XMLHttpRequest object
     */
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4 && r.status == 200) {
            c(r.response);
        }
    };
    r.open("GET", u, true);
    if (t) {r.responseType = t;}
    r.overrideMimeType('text/plain');
    r.send();
    return r;
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
    var host = "http://"+window.location.hostname;
    document.getElementById('nav').innerHTML =
        '<ul><li><a href="index.php">Home</a></li><li><a href="#">Anime</a></li><li><a href="#">Events</a></li><li><a href="#">Discussion</a></li><li><a href="#">Our group</a></li><li><a href="#">Contact</a></li></ul>';

    document.getElementById('header').innerHTML =
        '<h1>Anime Addicts Continue~!</h1><img class="logo" src="'+host+'/AAC/res/img/AAC_logo.png">';

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
}
