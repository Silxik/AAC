<? include('system/main.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <base href="<?= BASE_URL ?>">
    <title>Anime Addicts Continue</title>
    <link rel="shortcut icon" type="image/x-icon" href="res/img/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="res/css/style.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="res/js/main.js"></script>
</head>
<body>
<div id="divWrapper">
    <div id="header">
        <h1>Anime Addicts Continue~!</h1>
        <img class="logo" src="res/img/AAC_logo.png">
    </div>
    <div id="nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Anime</a></li>
            <li><a href="#">Events</a></li>
            <li><a href="#">Discussion</a></li>
            <li><a href="#">Our group</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>
    <div id="profile">
        <? if ($user) { ?>
            <b id="welcome">Welcome : <a href="profile"><? echo $user['username']; ?></a></b>
            <span class="icon" style="background-image:url('<? echo $row["profile_image"]; ?>');"></span>
            <b id="logout"><a href="logout">Log Out</a></b>
            <form id="iconUpload" action="profileUpload" method="post" enctype="multipart/form-data">
                <input type="file" name="iconUpload" value="Choose image">
                <input class="button" type="submit" value="Upload Image" name="submit">
            </form>
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

    <div id="currentlyOnline">
        <h2>Online:</h2>

        <div id="online">

        </div>
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


    <div id="footer">
        <p>AAC.com All rights reserved</p>
    </div>
</div>
</body>
</html>