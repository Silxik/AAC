<? include('system/main.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <base href="<?= BASE_URL ?>">
    <title>Anime Addicts Continue</title>
    <link rel="shortcut icon" type="image/x-icon" href="res/img/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="res/css/style.css">
    <script type="text/javascript" src="res/js/main.js"></script>
</head>
<body>
<div id="divWrapper">
    <div id="header"></div>

    <div id="nav"></div>

    <div id="profile">
        <? if ($loggedIn) { ?>
            <b id="welcome">Welcome : <a href="pages/profile.php"><? echo stripslashes($user); ?></a></b>
            <span class="icon" style="background-image:url('<? echo $row["profile_image"]; ?>');"></span>
            <b id="logout"><a href="pages/logout.php">Log Out</a></b>
            <form id="iconUpload" action="pages/profileUpload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="iconUpload" value="Choose image">
                <input class="button" type="submit" value="Upload Image" name="submit">
            </form>
        <? } else { ?>
            <form action="pages/login.php" method="post" autocomplete="off">
                <label for="username">UserName :</label>
                <input id="name" name="username" placeholder="username" type="text">
                <label for="password">Password :</label>
                <input id="password" name="password" placeholder="**********" type="password">
                <input class="button" name="submit" type="submit" value=" Login ">
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
        <h1>Hi <? if ($loggedIn) {
                echo stripslashes($user) . "!";
            }; ?></h1>

        <h2>Welcome to Anime Addicts Continue!</h2>

        <p>This site is currently under developement. Please stay in tune for further information!</p>
    </div>


    <div id="footer">
        <p>AAC.com All rights reserved</p>
    </div>
</div>
</body>
</html>