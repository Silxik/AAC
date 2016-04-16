<div class="profile-edit-block">
    <h1 class="header-h1">Edit Profile</h1>
    <div class="profile-edit-nav-container">
        <ul class="profile-nav-list">
            <li class="profile-nav-list-item"><a class="profile-nav-link" href="#">Personal info</a></li>
            <li class="profile-nav-line"></li>
            <li class="profile-nav-list-item"><a class="profile-nav-link" href="#">Privacy</a></li>
            <li class="profile-nav-line"></li>
            <li class="profile-nav-list-item"><a class="profile-nav-link profile-change" href="profile_edit_email_pass"><i class="fa fa-pencil" aria-hidden="true"></i>Edit email and password</a></li>
        </ul>
    </div>

    <div class="profile-edit-container">
        <form id="userForm" action="" method="" target="_self" enctype="multipart/form-data">
            <input id="user-id" type="hidden" name="id" value="<? echo $user['user_id']; ?>">
            <div>
                <label class="profile-form-label in-line" for="avatar">Upload your avatar : </label>
                <input id="file" name="avatar" type="file">
                <div class="preview-container">
                    <img class="image-preview" />
                </div>
            </div>

            <div>
                <label class="profile-form-label in-line" for="location">Country : </label>
                <input id="location" class="profile-edit-input" type="text" name="location" placeholder="State/City">
            </div>

            <div>
                <label class="profile-form-label in-line" for="gender">Gender : </label>
                <select id="gender" name="gender">
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
            </div>

            <div>
                <label class="profile-form-label in-line" for="birthday">Birthdate : </label>
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
            </div>

            <div>
                <label class="profile-form-label in-line text-area-label" for="bio">Bio : </label>
                <textarea id="bio" class="text-area" name="bio" placeholder="Your bio..."><?= $user['bio']?></textarea>
            </div>
            
            <div>
                <label class="profile-form-label in-line"></label>
                <input id="user-submit" type="submit" name="user-update" value="submit" class="button profile-edit-submit">
            </div>
            
            <div id="user-error"></div>
        </form>
    </div>

    <div class="content"></div>
    <div class="content"></div>
</div>