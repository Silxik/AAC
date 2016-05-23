function pageLoader(param){
    param ? $("body").prepend("<div class='loader-overlay'><span class='loader-image-align'></span><img class='loader-image' src='res/img/loading.gif'></div>") : $(".loader-overlay").remove() ;
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
        $('#mail-error').html('<h3 class="error-header">All fields must be filled!</h3>');
    } else if (email == '' || !re.test(email)) {
        $('#mail-error').html('<h3 class="error-header">Please enter a valid email address.</h3>');
    } else {
        pageLoader(true);

        $.ajax({
            url: "system/send.php",
            data: $("#contact-form").serialize(),
            type: "POST",
            success: function () {
                pageLoader();
                $("#contact-form").html('<h3 class="success-header">Thank you! Your mail has been sent!</h3><p>' + email + '</p><p>' + subject + '</p><p>' + message + '</p>');
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
                if ( data == 1 ) {
                    formData.find(".curPass").val('');
                    formData.find(".newPass").val('');
                    formData.find(".confirm").val('');
                    $('.errorlog').html('<h3 class="success-header">Password successfully changed! Page will refresh in 3 seconds!</h3>');
                    setTimeout(function(){ window.location.href = window.location.href }, 3000);
                } else {
                    $('.errorlog').html('<h3 class="error-header">'+data+'</h3>');
                }
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
                if ( data == 1 ) {
                    formData.find(".curPass").val('');
                    formData.find(".newMail").val('');
                    $('.errorlog').html('<h3 class="success-header">Email successfully changed! Page will refresh in 3 seconds!</h3>');
                    setTimeout(function(){ window.location.href = window.location.href }, 3000);
                } else {
                    $('.errorlog').html('<h3 class="error-header">'+data+'</h3>');
                }
            }
        });
    }
}

$(document).ready(function () {
    $(document).on('click', '.post-delete', function(){
        var postID = $(this).data('id');
        $.ajax({
            url:"system/update.php",
            data:{ post_id:postID, postDelete:'' },
            type:'post',
            success:function(data){
                if(data == 1) {
                    window.location = window.location;
                } else {
                    $(".errorlog").html("<h3 class='error-header'>" + data + "!</h3>");
                }
            }
        });
    }).on('click', '#about', function(e){
        e.preventDefault();
        var username = window.location.search.split('=')[1];

        $.post({
            url:"system/update.php",
            data:{ username:username, about:'' },
            success:function(data) {
                if (data == 0) {
                    $(".login-errorlog").html("<h3 class='error-header'>User not found!</h3>");
                } else {
                    $('.profile-container').html(data);
                }
            }
        });
    });

    $(document).on('submit', '#loginForm', function(e){
        e.preventDefault();
        console.log("test");

        var un = $("#username").val();
        var pw = $("#password").val();
        if(un == "") {
            $(".login-errorlog").html("<h3 class='error-header'>Empty username!</h3>");
        } else if ( pw == "" ) {
            $(".login-errorlog").html("<h3 class='error-header'>Empty password!</h3>");
        } else {
            $.ajax({
                url:"system/login.php",
                data: {un:un, pw:pw},
                type:"post",
                success:function(data){
                    if (data == "1"){
                        window.location = window.location;
                    } else {
                        $(".login-errorlog").html("<h3 class='error-header'>" + data + "!</h3>");
                    }
                }
            });
        }
    });

    // Password update
    $(document).on('submit', '#pass-update', function(e){
        e.preventDefault();
        updatePass( $(this) );
    });

    // Mail update
    $(document).on('submit', '#mail-update', function(e){
        e.preventDefault();
        updateMail( $(this) );
    });

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

    // Discussion topic toggle    
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

    // Contact form prevent page refresh
    $('#contact-form').submit(function () {
        return false;
    });

    $(document).on('click', '.user-link',function(){

        // Passes username to a hidden form & submits
        var userlink = $(this).text();
        $('#u-link-name').val(userlink);                    
        $('#u-link-fetch').submit();

    }).on('click', '.admin-nav-link', function(){

        // Toggle admin navigation links
        $(this).parent().children('.admin-editable').addClass('active');
        $('.admin-nav-link').addClass('hidden');
        $('.admin-return').removeClass('hidden');
    }).on('click', '.admin-return', function(){

        // Back to main admin navigation
        $('.admin-editable').removeClass('active');
        $('.admin-nav-link').removeClass('hidden');
        $(this).addClass('hidden');
    });

    // User post
    $(document).on('submit', '#userPost', function(e){
        e.preventDefault();

        var formData = new FormData(document.querySelector("#userPost"));
        formData.append('newPost','');

        $.ajax({
            url: 'system/update.php',
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                if ( data == 1 ) {
                    window.location = window.location;
                } else {
                    $('.errorlog').html('<h3 class="error-header">'+data+'</h3>');
                }
            }
        });
    });

    // User data update
    $(document).on('submit', '#userForm', function(e){
        e.preventDefault();
        
        var formData = new FormData(document.querySelector("#userForm"));
        formData.append('user-update','');

        $.ajax({
            url: 'system/update.php',
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                if ( data == 1 ) {
                    window.location = window.location;
                } else {
                    $('.errorlog').html('<h3 class="error-header">'+data+'</h3>');
                }
            }
        });
    });

    // Create a new discussion topic
    $(document).on('submit', '#new-discussion', function(e){
        e.preventDefault();
        var title = $('.new-discussion-title').val();
        var description = $('.new-discussion-description').val();

        if ( title == '' ) {
            $(".errorlog").html("<h3 class='error-header'>You must input your topic title.</h3>");
        } else if( description == '' ) {
            $(".errorlog").html("<h3 class='error-header'>You must input your topic description.</h3>");
        } else {
            var formData = new FormData(document.querySelector("#new-discussion"));
            formData.append('new-discussion','');

            $.ajax({
                url: 'system/update.php',
                type: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData:false,
                success: function (data) {
                    if ( data == 1 ) {
                        window.location = window.location;
                    } else {
                        $('.errorlog').html('<h3 class="error-header">'+data+'</h3>');
                    }
                }
            });
        }
    });

    $(document).on('submit', '#admin-style-editor-form', function(e){
        e.preventDefault();

        var CSSCode = $('#admin-style-editor').val();
        if( CSSCode.search('<') > -1 || CSSCode.search('>') > -1 ){
            $('.admin-panel-error-log').html('<h3 class="admin-panel-error-header">Please remove HTML tags to continue.</h3>');
        } else {
            $.ajax({
                url: 'system/update.php',
                type: 'POST',
                data: $('#admin-style-editor-form').serialize(),
                success: function (data) {
                        if ( data == 1 ) {
                            $('.admin-panel-error-log').html('<h3 class="admin-panel-success-header">Saved!</h3>');
                        } else {
                            $('.admin-panel-error-log').html('<h3 class="admin-panel-error-header">'+data+'</h3>');
                        }
                    }
            });
        }
    });

    // Update user profile background
    $('#userBackgroundEdit').submit(function(e){
        e.preventDefault();

        var formData = new FormData(document.querySelector("#userBackgroundEdit"));
        formData.append('user-background-edit','');
        
        $.ajax({
            url: 'system/update.php',
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                if ( data == 1 ) {
                    $('.admin-panel-error-log').html('<h3 class="admin-panel-success-header">Saved!</h3>');
                } else {
                    $('.admin-panel-error-log').html('<h3 class="admin-panel-error-header">'+data+'</h3>');
                }
            }
        });
    });
});

$(document).on("mousedown", ".admin-panel-drag", function(){
    $(this).addClass("draggable");

    $(document).on('mousemove', function(event) {
        if ( $(".admin-panel-drag").hasClass("draggable") ){
            $("*").css({'-moz-user-select':'-moz-none',
                   '-moz-user-select':'none',
                   '-o-user-select':'none',
                   '-khtml-user-select':'none',
                   '-webkit-user-select':'none',
                   '-ms-user-select':'none',
                   'user-select':'none'
             });
            var dragPanelW = $(".draggable").width() / 2;
            $(".admin-block").css("width", (event.pageX - dragPanelW) + "px");
            $(".main-page-block.move").css("marginLeft", (event.pageX + 20) + "px");
        }
    });
}).on('mouseup', function(){
    $(".admin-panel-drag").removeClass("draggable");
});
