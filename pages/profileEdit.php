<div class="errorlog"></div>

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
        <form id="userForm" method="POST" action="upload" enctype="multipart/form-data">
            <div>
                <label class="profile-form-label in-line" for="avatar">Upload your avatar : </label>
                <div class="custom-image-selection button" title="Choose attachment...">
                    <i class="fa fa-paperclip" aria-hidden="true"></i>
                </div>
                <input class="hidden" id="file" name="avatar" type="file">
                <div class="preview-container">
                    <label class="profile-form-label in-line"></label>
                    <img class="image-preview" />
                </div>
            </div>

            <div>
                <label class="profile-form-label in-line" for="location">Country : </label>
                <input id="location" class="profile-edit-input" type="text" name="location" placeholder="State/City" value="<?= !empty($user['location'])? $user['location'] : '' ?>">
            </div>

            <div>
                <label class="profile-form-label in-line" for="gender">Gender : </label>
                <div class="gender-dropdown">
                    <input class="gender-input" type="hidden" name="gender" value="<?= !empty($user['gender']) ? $user['gender'] : 'Male' ?>">
                    <div class="selected-gender"><?= !empty($user['gender']) ? $user['gender'] : 'Male' ?></div>
                    <ul class="gender-list">
                        <li class="gender-item">Male</li>
                        <li class="gender-item">Female</li>
                        <li class="gender-item">Other</li>
                    </ul>
                </div>
            </div>

            <div>
                <label class="profile-form-label in-line">Birthdate : </label>
                <div class="profile-form-date">
                    <div class="days">
                        <input class="date-input" type="hidden" name="day" value="<?= !empty($user['birthday']) && $user['birthday'] != '0000-00-00' ? explode('-',$user['birthday'])[2] : '' ?>">
                        <div class="selected-date"><?= !empty($user['birthday']) && $user['birthday'] != '0000-00-00' ? explode('-',$user['birthday'])[2] : 'day' ?></div>
                        <ul class="date-list scrollbar-inner"><? for ($i=1; $i <= 31; $i++) { ?>
                            <li class="date-item"><?= $i; ?></li>
                        <? } ?></ul>
                    </div>

                    <div class="months">
                        <input class="date-input" type="hidden" name="month" value="<?= !empty($user['birthday']) && $user['birthday'] != '0000-00-00' ? explode('-',$user['birthday'])[1] : '' ?>">
                        <div class="selected-date"><?= !empty($user['birthday']) && $user['birthday'] != '0000-00-00' ? explode('-',$user['birthday'])[1] : 'month' ?></div>
                        <ul class="date-list scrollbar-inner"><? for ($i=1; $i <= 12; $i++) { ?>
                            <li class="date-item"><?= $i; ?></li>
                        <? } ?></ul>
                    </div>

                    <div class="years">
                        <input class="date-input" type="hidden" name="year" value="<?= !empty($user['birthday']) && $user['birthday'] != '0000-00-00' ? explode('-',$user['birthday'])[0] : '' ?>">
                        <div class="selected-date"><?= !empty($user['birthday']) && $user['birthday'] != '0000-00-00' ? explode('-',$user['birthday'])[0] : 'year' ?></div>
                        <ul class="date-list scrollbar-inner"><? for ($i=1950; $i <= date("Y"); $i++) { ?>
                            <li class="date-item"><?= $i; ?></li>
                        <? } ?></ul>
                    </div>
                </div>
            </div>

            <div>
                <label class="profile-form-label in-line text-area-label" for="bio">Bio : </label>
                <textarea id="bio" class="text-area" name="bio" placeholder="Your bio..."><?= $user['bio']?></textarea>
            </div>
            
            <div>
                <label class="profile-form-label in-line"></label>
                <input id="user-submit" type="submit" name="user-update" value="Save" class="button profile-edit-submit">
            </div>
        </form>
    </div>

    <div class="content"></div>
    <div class="content"></div>
</div>