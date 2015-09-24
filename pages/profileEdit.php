<h1>Edit Profile</h1>
<div class="contentMenu">
    <ul>
        <li><a href="#">Personal info</a></li>
        <li><a href="#">Privacy</a></li>
        <li><a href="#">Change username or password</a></li>
    </ul>
</div>

<div class="content">
    <form action="profileEdit" method="POST">
        <input type="hidden" name="id" value="<? echo $user['user_id']; ?>">
        <label for="location" class="br">Location : </label><input type="text" name="location">
        <label for="gender" class="br">Gender : </label><select name="gender">
            <option value="0">Male</option>
            <option value="1">Female</option>
        </select>
        <label for="birthday" class="br">Birthdate : </label>
        <select name="day">
            <? foreach (range(31, 1) as $i) {
                echo '<option>' . $i . '</option>';
            } ?>
        </select>
        <select name="month">
            <? foreach (range(12, 1) as $i) {
                echo '<option>' . $i . '</option>';
            } ?>
        </select>
        <select name="year">
            <? foreach (range(date("Y"), 1950) as $i) {
                echo '<option>' . $i . '</option>';
            } ?>
        </select>
        <label for="bio" class="br">Bio : </label><textarea name="bio"></textarea>
        <input type="submit" name="update" class="button br" value="submit">
    </form>

    <?
    if (isset($_POST["update"])) {
        $id = $_POST["id"];
        $l = $db->real_escape_string($_POST["location"]);
        $g = $_POST["gender"];
        $d = $_POST["day"];
        $m = $_POST["month"];
        $y = $_POST["year"];
        $date = $y . '-' . $m . '-' . $d;
        $bio = $db->real_escape_string($_POST["bio"]);

        $sql = "UPDATE user SET location='$l', gender='$g', birthday = '$date', bio='$bio' WHERE user_id = $id";

        if ($db->query($sql)) {
            header('location: profileEdit');
        } else {
            echo 'Something went wrong! ' . $db->error;
        }
    }
    ?>
</div>

<div class="content"></div>
<div class="content"></div>