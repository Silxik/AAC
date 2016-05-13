<div class="errorlog"></div>

<div class="profile-block">
    <div class="profile-nav-block">
        <div class="profile-nav-left">
            <ul class="profile-nav-list">
                <li class="profile-nav-list-item"><a class="profile-nav-link">Timeline</a></li>
                <li class="profile-nav-line"></li>
                <li class="profile-nav-list-item"><a class="profile-nav-link">About</a></li>
                <li class="profile-nav-line"></li>
                <li class="profile-nav-list-item"><a class="profile-nav-link">Photos</a></li>
            </ul>
        </div>
        <? if ($user['username'] === $username ){ ?>
        <div class="profile-nav-right">
            <ul class="profile-nav-list">
                <li class="profile-nav-list-item"><a class="profile-nav-link" href="profileEdit">Edit profile</a></li>
            </ul>
        </div>
        <? } ?>
    </div>

    <div class="profile-container">
        <? if ($user) { ?>
        <form id="userPost" class="profile-form" method="POST" action="system/update" enctype="multipart/form-data">
            <label class="profile-form-label" for="text"></label><textarea name="text" placeholder="What's on your mind?"></textarea>
            <label class="profile-form-label" for="post_attachment">Choose file : </label><input style="color:white;" name="post_attachment" type="file">
            <input class="button" type="submit" name="newPost" value="Post">
        </form>
        <? } ?>

        <?
        while ($r = $q->fetch_assoc()) { ?>
            <div class="profile-userpost-container">
                <div class="profile-userpost-header">
                    <div class="user-icon-container small"><span class="user-icon-helper"></span><img class="user-icon" src="<?=$r["profile_image"];?>" onerror="this.onerror=null;this.src=&#34;uploads/avatars/default.jpg&#34;;"></div>
                    <a class="user-link small-text vertical-align"><?=$r["username"]; ?></a>
                    <small class="profile-userpost-date vertical-align"><?=$r["post_date"]; ?></small>
                </div>
                <pre class="profile-userpost-text"><?=$r["text"]; ?></pre>
            <? if($r['file_name'] !== ''){ ?>
                <img class="profile-userpost-image" src="<?=$r['file_name'];?>">
            <? } ?>
            </div>
            <?
            if($user){ ?>
                <div class="profile-userpost-delete-form">
                    <form method="post" action="">
                        <input id="fileId" name="fileId" type="hidden" value="<?=$r['file_id'] ?>">
                        <input name="delete_post" type="submit" class="button" value="Delete">
                    </form>
                </div>
            <? }
        }
        ?>
    </div>
</div>

<?
if (isset($_POST['delete_post'])){
    $file_id = $db->real_escape_string($_POST['fileId']);
    $db->query("DELETE FROM userpost, files USING userpost INNER JOIN files WHERE userpost.file_id = '$file_id' AND files.file_id = '$file_id'");
}
?>