<div class="errorlog"></div>

<div class="profile-block">
    <div class="profile-nav-block">
        <div class="profile-nav-left">
            <ul class="profile-nav-list">
                <li class="profile-nav-list-item"><a class="profile-nav-link" id="timeline">Timeline</a></li>
                <li class="profile-nav-line"></li>
                <li class="profile-nav-list-item"><a class="profile-nav-link" id="about">About</a></li>
                <li class="profile-nav-line"></li>
                <li class="profile-nav-list-item"><a class="profile-nav-link" id="photos">Photos</a></li>
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
            <textarea class="new-post-textarea" name="text" placeholder="What's on your mind?"></textarea>
            <div class="new-post-image-selection button" title="Choose attachment..."><i class="fa fa-paperclip" aria-hidden="true"></i></div>
            <input class="button new-post-submit" type="submit" name="newPost" value="Post">
            <input class="hidden" style="color:white;" id="post_attachment" name="post_attachment" type="file">
            <div class="preview-container">
                <img class="image-preview"/>
            </div>
        </form>
        <? } ?>

        <?
        while ($r = $q->fetch_assoc()) { ?>
            <div class="post-container">
                <div class="post-header">
                    <div class="user-icon-container small"><span class="user-icon-helper"></span><img class="user-icon" src="<?=$r["profile_image"];?>" onerror="this.onerror=null;this.src=&#34;uploads/avatars/default.jpg&#34;;"></div>
                    <div class="post-auth-block">
                        <a class="user-link post-username"><?=$r["username"]; ?></a>
                        <small class="post-date"><?=$r["post_date"]; ?></small>
                    </div>
                    <? if($user['username'] == $r['username']) { ?>
                        <span class="post-delete" data-id="<?= $r['post_id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></span>
                    <? } ?>
                </div>
                <pre class="post-text"><?=$r["text"]; ?></pre>
            <? if( !empty($r['file_name']) ) { ?>
                <img class="post-image" src="<?=$r['file_name'];?>">
            <? } ?>
            </div>
        <? } ?>
    </div>
</div>