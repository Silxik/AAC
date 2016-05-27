$(document).on('ready', function(){

    // Scrollbar plugin implement
    $('.scrollbar-inner').scrollbar();
    $('.users-list').scrollbar();
}).on('click', '.users-block-toggle', function(){

    // Toggle firechat user block
    if( $('.users-block').hasClass('active') ){
        $('.users-block').removeClass('active');
    } else {
        $('.users-block').addClass('active');

        var scrollHeight = $(window).scrollTop();
        var windowHeight = $(window).height();
        var navHeight = $('#nav')[0]['offsetTop'] + 75;
        $('.users-block.active').css('max-height', (windowHeight - navHeight + scrollHeight) + "px");
        $('.users-list').css('max-height', (windowHeight - navHeight + scrollHeight) + "px");
    }
}).on('click', '.sidebar-toggle', function(){

    // Toggle admin block
    if( $('.admin-block').hasClass('show') ){
        $('.admin-block').removeClass('show').addClass('hidden');
        $('.main-page-block').css("margin-left",0).removeClass('move');
        $('.sidebar-toggle.show').css('display','inline-block');
    } else {
        $('.admin-block').addClass('show').removeClass('hidden');
        $('.main-page-block').addClass('move');
        $('.sidebar-toggle.show').css('display','none');
    }
}).on('click', '.firechat-header', function () {

    // Toggle firechat container
    if( $(this).parent().children('.firechat-container').hasClass('active') ){
        $(this).parent().children('.firechat-container').removeClass('active');
    } else {
        $(this).parent().children('.firechat-container').addClass('active');
    }
}).on('click', '.selected-date', function() {

    // Toggle custom date selector
    if( $(this).parent().find('.date-list').hasClass('active') ) {
        $(this).parent().find('.date-list').removeClass('active');
    } else {
        $(this).parent().find('.date-list').addClass('active');
    }
}).on('click', '.date-item', function(){

    // Select date item
    $(this).parent().parent().parent().find('.date-input').val( $(this).text() );
    $(this).parent().parent().parent().find('.selected-date').text( $(this).text() );
    $(this).parent().removeClass('active');
    $(this).parent().parent().removeClass('active');
}).on('click', '.selected-gender', function(){

    // Toggle custom gender selector
    if( $(this).parent().find('.gender-list').hasClass('active') ) {
        $(this).parent().find('.gender-list').removeClass('active');
    } else {
        $(this).parent().find('.gender-list').addClass('active');
    }
}).on('click', '.gender-item', function(){

    // Select gender item
    $(this).parent().parent().parent().find('.gender-input').val( $(this).text() );
    $(this).parent().parent().parent().find('.selected-gender').text( $(this).text() );
    $(this).parent().removeClass('active');
    $(this).parent().parent().removeClass('active');
}).on('click', '.selected-theme', function(){

    // Toggle custom theme selector
    if( $(this).parent().find('.theme-list').hasClass('active') ) {
        $(this).parent().find('.theme-list').removeClass('active');
    } else {
        $(this).parent().find('.theme-list').addClass('active');
    }
}).on('click', '.theme-item', function(){

    // Select theme
    $(this).parent().parent().parent().find('.selected-theme').text( $(this).text() );
    $(this).parent().removeClass('active');
    $(this).parent().parent().removeClass('active');

    var themeName = $(this).text();

    if ( themeName == 'Default (Dark)' ) {
        var colorCode = '#FFF';
        var bgColorCode = 'rgba(0, 0, 0, 0.7)';
        var bgTrueColor = '#000';
        var borderColor = '#FFF';
    } else if ( themeName == 'Light' ) {
        var colorCode = '#000';
        var bgColorCode = 'rgba(255, 255, 255, 0.7)';
        var bgTrueColor = '#FFF';
        var borderColor = '#000';
    } else if ( themeName == 'Lightblue' ) {
        var colorCode = '#ADD8E6';
        var bgColorCode = 'rgba(173, 216, 230, 0.7)';
        var bgTrueColor = '#ADD8E6';
        var borderColor = '#FFF';
    } else if ( themeName == 'Orange' ) {
        var colorCode = '#000';
        var bgColorCode = 'rgba(255, 192, 203, 0.7)';
        var bgTrueColor = '#FFC0CB';
        var borderColor = '#FFF';
    } else {
        var colorCode = '#FFF';
        var bgColorCode = 'rgba(0, 0, 0, 0.7)';
        var bgTrueColor = '#000';
        var borderColor = '#FFF';
    }
    var themeStyle = '/* USING '+themeName.toUpperCase()+' THEME\n'+
        '** ======================== */\n'+
        '\n'+
        '/* FALLBACK FOR DARK THEME\n'+
        ' ------------------------- */\n'+
        '#header, #nav, #divWrapper, .header-nav-list, .post-container, .profile-nav-block {\n'+
        '   background-image: none;\n'+
        '}\n'+
        '\n'+
        'body {\n'+
        '   color:'+colorCode+';\n'+
        '}\n'+
        '* {\n'+
        '   border-color:'+borderColor+';\n'+
        '}\n'+
        '\n'+
        '/* HEADER BLOCK\n'+
        ' -------------------------- */\n'+
        '#header {\n'+
        '   background-color:'+bgColorCode+';\n'+
        '}\n'+
        '\n'+
        '/* NAVIGATION BLOCK\n'+
        ' -------------------------- */\n'+
        '#nav {\n'+
        '   background-color:'+bgColorCode+';\n'+
        '}\n'+
        '\n'+
        '.header-nav-list{\n'+
        '   background-color:'+bgColorCode+';\n'+
        '}\n'+
        '\n'+
        '.header-nav-link { '+
        '   color:'+colorCode+';\n'+
        '}\n'+
        '\n'+
        '/* SUBNAVIGATION BLOCK\n'+
        ' -------------------------- */\n'+
        '.profile-nav-block {\n'+
        '   background-color:'+bgColorCode+';\n'+
        '}\n'+
        '.profile-nav-link { '+
        '   color:'+colorCode+';\n'+
        '}\n'+
        '\n'+
        '/* PROFILE BLOCK\n'+
        ' -------------------------- */\n'+
        '#profile {\n'+
        '   background-color:'+bgColorCode+';\n'+
        '   color:'+colorCode+';\n'+
        '}\n'+
        '.user-link {\n'+
        '   background-color:'+bgColorCode+';\n'+
        '   color:'+colorCode+';\n'+
        '}\n'+
        '#logout a {\n'+
        '   color:'+colorCode+';\n'+
        '}\n'+
        '/* MAIN BLOCK\n'+
        ' -------------------------- */\n'+
        '#divWrapper {\n'+
        '   background-color:'+bgColorCode+';\n'+
        '}\n'+
        '.button {\n'+
        '   background-color:'+bgColorCode+';\n'+
        '   color:'+colorCode+';\n'+
        '}\n'+
        '\n'+
        '/* POST BLOCK\n'+
        ' -------------------------- */\n'+
        '.post-container {\n'+
        '   background-color:'+bgColorCode+';\n'+
        '}\n'+
        '.post-delete {\n'+
        '   color:'+colorCode+';\n'+
        '}\n'+
        '.new-post-textarea {\n'+
        '   background-color:'+bgColorCode+';\n'+
        '   color:'+colorCode+';\n'+
        '}\n'+
        '.new-post-comment-textarea {\n'+
        '   background-color:'+bgColorCode+';\n'+
        '   color:'+colorCode+';\n'+
        '}\n'+
        '/* FIRECHAT\n'+
        ' -------------------------- */\n'+
        '.firechat-block {\n'+
        '   background-color:'+bgTrueColor+';\n'+
        '   color:'+colorCode+';\n'+
        '}\n'+
        '.messageInput {\n'+
        '   background-color:'+bgColorCode+';\n'+
        '   color:'+colorCode+';\n'+
        '}\n'+
        '/* USERS DROPDOWN\n'+
        ' -------------------------- */\n'+
        '.users-block-toggle {\n'+
        '   background-color:'+bgTrueColor+';\n'+
        '}\n'+
        '/* FOOTER\n'+
        ' -------------------------- */\n'+
        '#footer {\n'+
        '   background-color:'+bgTrueColor+';\n'+
        '}\n'+
        '.footer-text-container {\n'+
        '   color:'+colorCode+';\n'+
        '}\n'+
        '/* ADMIN BLOCK\n'+
        ' -------------------------- */\n'+
        '.admin-block {\n'+
        '   background-color:'+bgTrueColor+';\n'+
        '   color:'+colorCode+';\n'+
        '}\n'+
        '.selected-theme {\n'+
        '   background-color:'+bgTrueColor+';\n'+
        '   color:'+colorCode+';\n'+
        '}\n'+
        '.theme-list {\n'+
        '   background-color:'+bgTrueColor+';\n'+
        '   color:'+colorCode+';\n'+
        '}\n';

    $('#admin-style-editor').val( themeStyle );
    $('#user-style-editor-code').text( themeStyle );

}).on('click', '.theme-submit', function(){

    // Submit CSS style editor
    $('#admin-style-editor-form').submit();
}).on('click', '.user-chat .firechat-close', function(){

    // Close user firechat container
    $(this).parent().remove();
}).on('click', '.new-post-image-selection', function(){

    // Custom button for file selection
    $('#post_attachment').click();
}).on('click', '.new-discussion-image-selection', function(){

    // Custom button for file selection
    $('#file').click();
}).on('click', '.custom-image-selection', function(){

    // Custom button for file selection
    $('#file').click();
}).on('click', '.userUI-custom-image-selection', function(){

    $('#bgImage').click();
}).on('change', '#bgImage', function(e){
    var preview = $(".admin-panel-preview");

    var file = this.files[0];
    var reader = new FileReader();
    reader.onload = function (e) {
        preview.attr('src', e.target.result);
    };
    reader.readAsDataURL(file);
}).on('change', '#post_attachment', function(e){
    var preview = $(".image-preview");

    var file = this.files[0];
    var reader = new FileReader();
    reader.onload = function (e) {
        preview.attr('src', e.target.result);
    };
    reader.readAsDataURL(file);
});

// Admin panel real-time CSS editor
$(document).on('keyup', '#admin-style-editor', function(e){
    $('#user-style-editor-code').html( $(this).val() );

    var CSSCode = $(this).val();
    ( CSSCode.search('<') > -1 ) || (CSSCode.search('>') > -1 ) ?
        $('.admin-panel-error-log').html('<h3 class="admin-panel-error-header">Please remove HTML tags to continue.</h3>') : 
        $('.admin-panel-error-log').html('');
});

// textarea tab override for space  
$(document).delegate('#admin-style-editor', 'keydown', function(e) {
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

// Resize members block on scroll
$(window).scroll(function(){
    var scrollHeight = $(window).scrollTop();
    var windowHeight = $(window).height();
    var navHeight = $('#nav')[0]['offsetTop'] + 75;
    $('.users-block.active').css('max-height', (windowHeight - navHeight + scrollHeight) + "px");
    $('.users-list').css('max-height', (windowHeight - navHeight + scrollHeight) + "px");
});
/** Todo focused string to span element
 *
 */
/*
$(document).on('mouseup', function(e){
    var selectionStr = window.getSelection().toString();
    console.log( e['target']['innerHTML'] );
});
*/