<div class="prof">
    <h1>Edit Profile</h1>
    <div class="contentMenu">
        <ul>
            <li><a href="#">Personal info</a></li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Change username or password</a></li>
        </ul>
    </div>

    <div class="content">
        <form action="profileEdit" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<? echo $user['user_id']; ?>">
            <label for="avatar" class="br">Upload your avatar : </label><input id="file" name="avatar" type="file">
            <div id="upload-preview">
                <img id="avatar" />
            </div>
            <label for="location" class="br">Location : </label><input type="text" name="location" placeholder="State/City">
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
            <label for="bio" class="br">Bio : </label><textarea name="bio" placeholder="Your bio..."></textarea>
            <input type="submit" name="update" class="button br" value="submit">
        </form>
    </div>

    <div class="content"></div>
    <div class="content"></div>
</div>