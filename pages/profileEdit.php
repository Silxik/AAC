<div class="profile-edit-block">
    <h1 class="header-h1">Edit Profile</h1>
    <div class="profile-edit-nav-container">
        <ul class="profile-nav-list">
            <li class="profile-nav-list-item"><a class="profile-nav-link" href="#">Personal info</a></li>
            <li class="profile-nav-line"></li>
            <li class="profile-nav-list-item"><a class="profile-nav-link" href="#">Privacy</a></li>
            <li class="profile-nav-line"></li>
            <li class="profile-nav-list-item"><a class="profile-nav-link" href="#">Change username or password</a></li>
        </ul>
    </div>

    <div class="profile-edit-container">
        <form action="upload" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<? echo $user['user_id']; ?>">
            <label class="profile-form-label" for="avatar">Upload your avatar : </label><input id="file" name="avatar" type="file">
            <div class="preview-container">
                <img id="image-preview" />
            </div>
            <label class="profile-form-label" for="location">Location : </label>
            <input class="profile-edit-input" type="text" name="location" placeholder="State/City">
            <label class="profile-form-label" for="gender">Gender : </label>
            <select name="gender">
                <option value="0">Male</option>
                <option value="1">Female</option>
            </select>
            <label class="profile-form-label" for="birthday">Birthdate : </label>
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
            <label class="profile-form-label" for="bio">Bio : </label><textarea name="bio" placeholder="Your bio..."></textarea>

            <div><input type="submit" name="update" class="button" value="submit"></div>
        </form>
    </div>

    <div class="content"></div>
    <div class="content"></div>
</div>