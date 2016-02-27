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
        <div class="profile-nav-right">
            <ul class="profile-nav-list">
                <li class="profile-nav-list-item"><a class="profile-nav-link" href="profileEdit">Edit profile</a></li>
            </ul>
        </div>
    </div>

    <div class="profile-container">
        <form method="POST" action="upload" enctype="multipart/form-data">
            <label class="profile-form-label" for="text"></label><textarea name="text" placeholder="What's on your mind?"></textarea>
            <label class="profile-form-label" for="post_attachment">Choose file : </label><input style="color:white;" name="post_attachment" type="file">
            <input type="hidden" name="id" value="<? echo $user['user_id']; ?>">
            <input class="button" type="submit" name="newPost" value="Post">
        </form>

        <?
        $u_id = $user['user_id'];
        $q = $db->query("SELECT * FROM userpost U INNER JOIN files F ON U.file_id = F.file_id INNER JOIN user US ON US.user_id = U.user_id WHERE U.user_id = $u_id ORDER BY post_date DESC");
        while ($r = $q->fetch_assoc()) { ?>
            <div class="profile-userpost-container">
                <div class="profile-userpost-header">
                    <span class="user-icon small vertical-align" style="background-image:url('<?=$r["profile_image"];?>')"></span>
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
                    <form method="post" action="profile">
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
    $del = $db->query("DELETE FROM userpost, files USING userpost INNER JOIN files WHERE userpost.file_id = '$file_id' AND files.file_id = '$file_id'");
    if($del){
        header("location: profile");
    } else{
        exit('Mysql error: ' . $db->error);
    }
}
?>