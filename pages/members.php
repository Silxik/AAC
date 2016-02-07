<h1>All Members</h1>
<div class="members">
    <? foreach ($users as $member) { ?>
        <div class="member">
            <span class="icon" style="background-image: url('<?= $member["profile_image"]; ?>')"></span>
            <a href="profile"><?= $member['username'] ?></a>
        </div>
    <? } ?>
</div>