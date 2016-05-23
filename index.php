<? include('system/main.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <base href="<?= BASE_URL ?>">
    <title>Anime Addicts Continue</title>
    <link rel="shortcut icon" type="image/x-icon" href="res/img/favicon.ico"/>
    <link rel="stylesheet" href="res/css/font-awesome.min.css">
    <script type="text/javascript" src="res/js/jquery-1.12.2.min.js"></script>
    <script type="text/javascript" src="res/js/jquery.scrollbar.min.js"></script>
    <script src="https://cdn.firebase.com/js/client/2.3.1/firebase.js"></script>
    <script type="text/javascript" src="res/js/functions.js"></script>
    <link rel="stylesheet" type="text/css" href="res/css/jquery.scrollbar.css">
    <link rel="stylesheet" type="text/css" href="res/css/style.css">
</head>
<body>
    <? include("system/admin-panel.php"); ?>
    <div class="main-page-block">
        <div id="header">
            <a class="header-link" href="http://localhost/AAC/">
                <img class="logo" src="res/img/AAC_logo.png" alt="Anime Addicts Continue logo" />
                <h2 class="page-title">AnimeAddicts<br>Continue~!</h2>
            </a>
        </div>
        <div id="nav">
            <ul class="header-nav-list">
                <li class="header-nav-list-item"><a class="header-nav-link" href="http://localhost/AAC/">Home</a></li>
                <li class="header-nav-list-item events"><a class="header-nav-link" href="events">Events</a>
                    <ul class="header-subnav-list">
                        <li class="header-subnav-item"><a href="anime" class="header-subnav-link">Top Anime Selection</a></li>
                        <li class="header-subnav-item"><a href="events" class="header-subnav-link">Active events</a></li>
                    </ul>
                </li>
                <li class="header-nav-list-item"><a class="header-nav-link" href="discussion">Discussion</a></li>
                <li class="header-nav-list-item"><a class="header-nav-link" href="members">Members</a></li>
                <li class="header-nav-list-item"><a class="header-nav-link" href="about">About us</a></li>
                <li class="header-nav-list-item"><a class="header-nav-link" href="contact">Contact</a></li>
            </ul>
            <div class='users-block-toggle'><i class="fa fa-users"></i></div>
        </div>

        <div id="divWrapper">
            <? include("system/members-panel.php"); ?>
            <div id="profile">
                <? if ($user) { ?>
                    <b class="welcome-text">Welcome : <a class="user-link"><?= $user['username']; ?></a></b>
                    <div class="user-icon-container">
                        <img class="user-icon" src="<?= $user["profile_image"]; ?>" onerror="this.onerror=null;this.src=&#34;uploads/avatars/default.jpg&#34;;">
                        <span class="user-icon-helper"></span>
                    </div>
                    <b id="logout"><a href="system/logout.php">Log Out</a></b>
                <? } else { ?>
                    <div class="login-errorlog"></div>
                    <form id="loginForm" autocomplete="off">
                        <label for="username">UserName :</label>
                        <input id="username" name="username" placeholder="username" type="text">
                        <label for="password">Password :</label>
                        <input id="password" name="password" placeholder="password" type="password">
                        <input class="button" type="submit" value="Login">
                        <a class="button" href="register">Register</a>
                    </form>
                <? } ?>
            </div>

            <div id="main">
                <?
                $page = 'pages/' . $url[0] . '.php';
                if (!file_exists($page)) {
                    $page = 'pages/404.php';
                }
                include($page);
                ?>
            </div>

            <div class="clearfix"></div>
        </div>

        <div id="footer">
            <div class="footer-block">
                <!-- FIRECHAT -->
                <div class="firechat-block main-chat" data-id="main-chat">
                    <h2 class="firechat-header">Main chat</h2>
                    <div class="firechat-container">
                        <ul class="messages firechat-list scrollbar-inner"></ul>
                        <? if ($user) { ?>
                            <input class="messageInput firechat-text" type="text" placeholder="Type a message...">
                        <? } else {
                            echo "Please log in first.";
                        } ?>
                    </div>
                </div>
                <div class="footer-text-container">
                    <p class="footer-text">Andresspak@gmail.com. All rights reserved.</p>
                </div>
            </div>
        </div>
        <form class="hidden" id="u-link-fetch" method="get" action="profile">
            <input id="u-link-name" type="hidden" value="" name="username">
            <input type="submit" name="user-link">
        </form>
    </div>

    <script>
        /* REALTIME FIREBASE CHAT
        ** ========================================================================== */
        var keys = [];
        var uNames = [];
        var uImages = [];

        var curDate = new Date().toLocaleString();

        <? $sql = $db->query('SELECT username, profile_image FROM user');
        while( $query = $sql->fetch_assoc() ){ ?>
            uNames.push('<?= $query['username']; ?>');
            uImages.push('<?= $query['profile_image']; ?>');
        <? } ?>

        var firebaseRef = new Firebase('https://kurikutsu.firebaseio.com/');

        $(document).on('click', '.user-items', function(){

            var selectedUser = $(this).children('.user-item-username').text();
            var activeUser = "<?= $user['username']; ?>";
            var usernames = selectedUser + activeUser;

            var chatKey = 0;
            for( var i = 0; i < usernames.length; i++ ){
                var chatKey = chatKey + usernames.charCodeAt(i);
            }

            var rightShift = $('.footer-block').find('.firechat-block').length * 260;
            if($('.footer-block').find('.firechat-header:contains("'+selectedUser+'")').length < 1 && selectedUser != activeUser){
                keys.push(chatKey);

                $('.footer-block').append(
                    '<div class="firechat-block user-chat" data-id="'+chatKey+'" style="right:'+rightShift+'px;">'+
                        '<span class="firechat-close">x</span>' +
                        '<h2 class="firechat-header">'+selectedUser+'</h2>'+
                        '<div class="firechat-container">'+
                            '<ul class="messages firechat-list scrollbar-inner"></ul>'+
                            '<input class="messageInput firechat-text" type="text" placeholder="Type a message...">'+ 
                        '</div>'+
                    '</div>');

                firebaseRef.child(chatKey).limitToLast(100).on('child_added', function (snapshot) {
                    var messageList = $('.firechat-block[data-id="'+chatKey+'"]').find('ul.messages');
                    //GET DATA
                    var data = snapshot.val();

                    var username = data.name;
                    var message = data.text;
                    var date = data.date;


                    var pos = $.inArray(username, uNames);

                    //CREATE ELEMENTS MESSAGE & SANITIZE TEXT
                    var messageBlock = $('<li class="firechat-message">');
                    var messageElement = $('<span class="firechat-message"></span>');
                    var nameElement = $('<div class="user-icon-container chat-icon"><span class="user-icon-helper"></span><img class="user-icon" src="'+ uImages[pos] +'"  onerror="this.onerror=null;this.src=&#34;uploads/avatars/default.jpg&#34;;">');
                    nameElement.attr('title',username + ', ' + date);
                    messageElement.text(message);

                    messageBlock.append(messageElement).prepend(nameElement);

                    messageList.append(messageBlock); //ADD MESSAGE
                    messageList[0].scrollTop = messageList[0].scrollHeight; //SCROLL TO BOTTOM OF MESSAGE LIST
                });

                $('.scrollbar-inner').scrollbar();
            }

        }).on('keypress', '.messageInput', function(e){
            if(e.keyCode == 13) {
                var chatKey = $(this).parent().parent().data('id');

                var username = '<?= $user['username']; ?>';
                var message = $(this).val();
                var curDate = new Date().toLocaleString();

                firebaseRef.child(chatKey).push({name: username, text: message, date: curDate});
                $(this).val('');
            }
        });

        firebaseRef.child('main-chat').limitToLast(100).on('child_added', function (snapshot) {
            var messageList = $('.firechat-block[data-id="main-chat"]').find('ul.messages');
            //GET DATA
            var data = snapshot.val();

            var username = data.name;
            var message = data.text;
            var date = data.date;


            var pos = $.inArray(username, uNames);

            //CREATE ELEMENTS MESSAGE & SANITIZE TEXT
            var messageBlock = $('<li class="firechat-message">');
            var messageElement = $('<span class="firechat-message"></span>');
            var nameElement = $('<div class="user-icon-container chat-icon"><span class="user-icon-helper"></span><img class="user-icon" src="'+ uImages[pos] +'"  onerror="this.onerror=null;this.src=&#34;uploads/avatars/default.jpg&#34;;"></div>');
            nameElement.attr('title',username + ', ' + date);
            messageElement.text(message);

            messageBlock.append(messageElement).prepend(nameElement);

            messageList.append(messageBlock); //ADD MESSAGE
            messageList[0].scrollTop = messageList[0].scrollHeight; //SCROLL TO BOTTOM OF MESSAGE LIST
        });
    </script>
    <script type="text/javascript" src="res/js/main.js"></script>
    <? $db->close(); ?>
</body>
</html>