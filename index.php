<? include('system/main.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <base href="<?= BASE_URL ?>">
    <title>Anime Addicts Continue</title>
    <link rel="shortcut icon" type="image/x-icon" href="res/img/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="res/css/style.css">
    <script type="text/javascript" src="res/js/main.js"></script>
    <script src="https://cdn.firebase.com/js/client/2.3.1/firebase.js"></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js'></script>
</head>
<body>
    <div id="header">
        <img class="logo" src="res/img/AAC_logo.png" alt="Anime Addicts Continue logo" />
        <h1>Anime Addicts<br>Continue~!</h1>
    </div>
    <div id="nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Anime</a></li>
            <li><a href="events">Events</a></li>
            <li><a href="discussion">Discussion</a></li>
            <li><a href="members">Members</a></li>
            <li><a href="about">About us</a></li>
            <li><a href="contact">Contact</a></li>
        </ul>
    </div>

    <div id="divWrapper">
        <div id="profile">
            <? if ($user) { ?>
                <b class="welcome">Welcome : <a href="profile"><?= $user['username']; ?></a></b>
                <span class="icon" style="background-image: url('<?= $user["profile_image"]; ?>')"></span>
                <b id="logout"><a href="logout">Log Out</a></b>
            <? } else { ?>
                <form id="loginForm" autocomplete="off">
                    <label for="username">UserName :</label>
                    <input id="username" name="username" placeholder="username" type="text">
                    <label for="password">Password :</label>
                    <input id="password" name="password" placeholder="password" type="password">
                    <input class="button" onclick="login()" name="submit" type="button" value="Login">
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
        <div class="footer-content">
            <!-- FIRECHAT -->
            <div id="chat">
                <h2 class="chat-toggle">Chat</h2>
                <div class="chat-content">
                    <ul id='messages' class="chat-messages"></ul>
                    <? if ($user) { ?>
                        <input type='text' id='messageInput' placeholder='Type a message...'>
                    <? } else {
                        echo "Please log in first.";
                    } ?>
                </div>
            </div>
            <div class="footer-text">
                <p>Andresspak@gmail.com. All rights reserved.</p>
            </div>
        </div>
    </div>

<script>
    // CREATE A REFERENCE TO FIREBASE
    var messagesRef = new Firebase('https://kurikutsu.firebaseio.com/');

    // REGISTER DOM ELEMENTS
    var messageField = $('#messageInput');

    /*
     To create an anonymous webchat for everyone who visits the site, do the following:
     1.  replace nameInput variable value with the following - $('#nameInput').val()
     2.  Add this HTML line inside chat-content div element.
     <div class='chat-toolbar'><input type='text' id='nameInput' placeholder='Enter a username...'></div>

     */

    var nameField = "<?= $user['username'];?>";
    var messageList = $('#messages');

    // LISTEN FOR KEYPRESS EVENT
    messageField.keypress(function (e) {
        if (e.keyCode == 13) {
            //FIELD VALUES
            var username = nameField;
            var message = messageField.val();

            //SAVE DATA TO FIREBASE AND EMPTY FIELD
            messagesRef.push({name:username, text:message});
            messageField.val('');
        }
    });

    // Add a callback that is triggered for each chat message.
    messagesRef.limitToLast(10).on('child_added', function (snapshot) {
        //GET DATA
        var data = snapshot.val();
        var username = data.name || "anonymous";
        var message = data.text;

        //CREATE ELEMENTS MESSAGE & SANITIZE TEXT
        var messageElement = $("<li>");
        var nameElement = $("<strong class='chat-username'></strong>");
        nameElement.text(username);
        messageElement.text(message).prepend(nameElement);

        //ADD MESSAGE
        messageList.append(messageElement)

        //SCROLL TO BOTTOM OF MESSAGE LIST
        messageList[0].scrollTop = messageList[0].scrollHeight;
    });

    $('#chat .chat-toggle').click(function () {
        $('#chat .chat-content').animate({height: 'toggle'});
    });
</script>
</body>
</html>