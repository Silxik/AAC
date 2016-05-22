<?
$q = $db->query("SELECT * FROM userpost U INNER JOIN user US ON US.user_id = U.user_id ORDER BY post_date DESC");
?>

<div class="errorlog"></div>
<div id="index" class="main-block">
    <h2 class="header-h1">Welcome to Anime Addicts Continue!</h2>

    <p>This site is currently under developement. Please stay in tune for further information!</p>

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
    <?
    }

    while ($r = $q->fetch_assoc()) { ?>
        <div class="post-container">
            <div class="post-header">
                <div class="user-icon-container small"><span class="user-icon-helper"></span><img class="user-icon" src="<?= $r["profile_image"]; ?>" onerror="this.onerror=null;this.src=&#34;uploads/avatars/default.jpg&#34;;"></div>
                <div class="post-auth-block">
                    <a class="user-link post-username"><?=$r["username"]; ?></a>
                    <small class="post-date"><?=$r["post_date"]; ?></small>
                </div>
                <? if($user['username'] == $r['username']) { ?>
                    <span class="post-delete" data-id="<?= $r['post_id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></span>
                <? } ?>
            </div>
            <pre class="post-text"><?= htmlspecialchars($r["text"]); ?></pre>
            <? if( !empty($r['file_name']) ){ ?>
                <img class="post-image" src="<?= $r['file_name']; ?>"  onerror="this.onerror=null;this.src=&#34;uploads/avatars/default.jpg&#34;;">
            <? } ?>
        </div>
    <? } ?>
</div>