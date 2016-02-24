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
        <h2 class="page-title">Anime Addicts<br>Continue~!</h2>
    </div>
    <div id="nav">
        <ul class="header-nav-list">
            <li class="header-nav-list-item"><a class="header-nav-link" href="index.php">Home</a></li>
            <li class="header-nav-list-item"><a class="header-nav-link" href="anime">Anime</a></li>
            <li class="header-nav-list-item"><a class="header-nav-link" href="events">Events</a></li>
            <li class="header-nav-list-item"><a class="header-nav-link" href="discussion">Discussion</a></li>
            <li class="header-nav-list-item"><a class="header-nav-link" href="members">Members</a></li>
            <li class="header-nav-list-item"><a class="header-nav-link" href="about">About us</a></li>
            <li class="header-nav-list-item"><a class="header-nav-link" href="contact">Contact</a></li>
        </ul>
    </div>

    <div id="divWrapper">
        <div id="profile">
            <? if ($user) { ?>
                <b class="welcome-text">Welcome : <a class="user-link"><?= $user['username']; ?></a></b>
                <span class="user-icon" style="background-image: url('<?= $user["profile_image"]; ?>')"></span>
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
        <div class="footer-block">
            <!-- FIRECHAT -->
            <div class="firechat-block">
                <h2 class="firechat-header">Chat</h2>
                <div class="firechat-container">
                    <ul id='messages' class="firechat-list"></ul>
                    <? if ($user) { ?>
                        <input id='messageInput' class="firechat-text" type='text' placeholder='Type a message...'>
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
    <form class="hidden" id="u-link-fetch" method="post" action="profile">
        <input id="u-link-name" type="hidden" value="" name="username">
        <input type="submit" name="user-link">
    </form>
    <script type="text/javascript" src="res/js/main.js"></script>
</body>
</html>