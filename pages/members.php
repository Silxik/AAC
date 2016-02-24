<div class="members-block">
    <h1 class="header-h1">All Members</h1>
    <div class="members-container">
        <? foreach ($users as $member) { ?>
            <div class="user-container">
                <span class="user-icon" style="background-image: url('<?= $member["profile_image"]; ?>')"></span>
                <a class="user-link member-link"><?= $member['username'] ?></a>
            </div>
        <? } ?>
    </div>
</div>