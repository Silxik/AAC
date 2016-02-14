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
    <script src="https://cdn.firebase.com/js/client/2.3.1/firebase.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="res/js/functions.js"></script>
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

</script>
    <script type="text/javascript" src="res/js/main.js"></script>
</body>
</html>