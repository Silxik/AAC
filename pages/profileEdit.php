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
        <form id="userForm" action="" method="" target="_self" enctype="multipart/form-data">
            <input id="user-id" type="hidden" name="id" value="<? echo $user['user_id']; ?>">
            <label class="profile-form-label" for="avatar">Upload your avatar : </label>
            <input id="file" name="avatar" type="file">
            <div class="preview-container">
                <img class="image-preview" />
            </div>
            <label class="profile-form-label" for="location">Country : </label>
            <input id="location" class="profile-edit-input" type="text" name="location" placeholder="State/City">
            <label class="profile-form-label" for="gender">Gender : </label>
            <select id="gender" name="gender">
                <option value="0">Male</option>
                <option value="1">Female</option>
            </select>
            <label class="profile-form-label" for="birthday">Birthdate : </label>
            <select id="day" name="day">
                <? foreach (range(31, 1) as $i) {
                    echo '<option>' . $i . '</option>';
                } ?>
            </select>
            <select id="month" name="month">
                <? foreach (range(12, 1) as $i) {
                    echo '<option>' . $i . '</option>';
                } ?>
            </select>
            <select id="year" name="year">
                <? foreach (range(date("Y"), 1950) as $i) {
                    echo '<option>' . $i . '</option>';
                } ?>
            </select>
            <label class="profile-form-label" for="bio">Bio : </label>
            <textarea id="bio" name="bio" placeholder="Your bio..."></textarea>

            <input id="user-submit" type="submit" name="user-update" value="submit" class="button">
            <div id="user-error"></div>
        </form>
    </div>

    <div class="content"></div>
    <div class="content"></div>
</div>