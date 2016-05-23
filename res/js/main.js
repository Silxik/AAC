$(document).on('ready', function(){

    // Scrollbar plugin implement
    $('.scrollbar-inner').scrollbar();
}).on('click', '.users-block-toggle', function(){

    // Toggle firechat user block
    if( $('.users-block').hasClass('active') ){
        $('.users-block').removeClass('active');
    } else {
        $('.users-block').addClass('active');
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