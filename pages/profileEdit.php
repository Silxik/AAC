<? include("system/main.php") ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    <link rel="shortcut icon" type="image/x-icon" href="../res/img/favicon.ico" />
    <title>Home Page</title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="divWrapper">
    <div id="header"></div>

    <div id="nav"></div>

    <div id="main">
        <h1>Edit Profile</h1>
        <form action="profileEdit" method="POST">
            <label for="newUsername" class="br">Change username : </label><input type="text" name="newUsername">
            <label for="newPassword" class="br">Change password : </label><input type="password" name="newPassword">
            <label for="location" class="br">Location : </label><input type="text" name="location">
            <label for="gender" class="br">Gender : </label><select><option value="0">Male</option><option value="1">Female</option></select>
            <label for="birthday" class="br">Birthdate : </label>
            <select name="day">
                <? foreach(range(31, 1) as $i) {
                    echo '<option>'. $i .'</option>';
                } ?>
            </select>
            <select name="month">
                <? foreach(range(12, 1) as $i) {
                    echo '<option>'. $i .'</option>';
                } ?>
            </select>
            <select name="year">
                <? foreach(range(date("Y"), 1950) as $i) {
                    echo '<option>'. $i .'</option>';
                } ?>
            </select>
            <label for="bio" class="br">Bio : </label><textarea name="bio"></textarea>
            <input type="submit" name="update" class="button br" value="submit">
        </form>
    </div>
</div>
<script type="text/javascript" src="../res/js/main.js"></script>
</body>
</html>

<?
if(isset($_POST["update"])){
    $newUsername = $db->real_escape_string($_POST["newUsername"]);
    $newPassword = $db->real_escape_string($_POST["newPassword"]);
    $l = $db->real_escape_string($_POST["location"]);
    $g = $_POST["gender"];
    $d = $_POST["day"];
    $m = $_POST["month"];
    $y = $_POST["year"];
    $bio = $db->real_escape_string($_POST["bio"]);

    $sql = 'UPDATE user SET username="$newUsername", password="$newPassword", location="$l", birthday="$d-$m-$y", bio="$bio"';
    if($db->query($sql)){

    }else{}
}
?>