document.getElementById('nav').innerHTML =
'<ul><li><a href="index.php">Home</a></li><li><a href="#">Anime</a></li><li><a href="#">Events</a></li><li><a href="#">Discussion</a></li><li><a href="#">Our group</a></li><li><a href="#">Contact</a></li></ul>';

document.getElementById('header').innerHTML =
'<h1>Anime Addicts Continue~!</h1><img class="logo" src="pildid/AAC_logo.png">';

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

$('#profile span.icon').click(function(){
	$('#iconUpload').toggle();
});