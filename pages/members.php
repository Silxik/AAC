<div class="members-block">
    <h1 class="header-h1">All Members</h1>
    <div class="members-container">
        <? foreach ($users as $member) { ?>
            <div class="user-container">
                <img class="user-icon" src="<?= $member["profile_image"]; ?>" onerror="this.onerror=null;this.src=&#34;uploads/avatars/default.jpg&#34;;">
                <a class="user-link member-link"><?= $member['username'] ?></a>
            </div>
        <? } ?>
    </div>
</div>