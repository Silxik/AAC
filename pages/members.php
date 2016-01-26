<div id="members">
    <h1>All Members</h1>
    <? foreach ($users as $member) { ?>
        <div class="member">
            <span class="icon" style="background-image: url('<?= $member["profile_image"]; ?>')"></span>
            <a href=""><?= $member['username'] ?></a>
        </div>
    <? } ?>
</div>