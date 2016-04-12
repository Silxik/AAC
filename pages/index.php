<?
$q = $db->query("SELECT * FROM userpost U INNER JOIN files F ON U.file_id = F.file_id INNER JOIN user US ON US.user_id = U.user_id ORDER BY post_date DESC");
?>

<div id="index" class="main-block">
    <h1 class="header-h1">Hi <? if ($user) {
        echo htmlspecialchars($user['username']);
    }; ?>!</h1>

        <h2>Welcome to Anime Addicts Continue!</h2>

    <p>This site is currently under developement. Please stay in tune for further information!</p>
    <pre>
        
    </pre>

    <?
    while ($r = $q->fetch_assoc()) { ?>
        <div class="profile-userpost-container">
            <div class="profile-userpost-header">
                <img class="user-icon small vertical-align" src="<?= $r["profile_image"]; ?>">
                <a class="user-link small-text vertical-align"><?= $r["username"]; ?></a>
                <small class="profile-userpost-date vertical-align"><?= $r["post_date"]; ?></small>
            </div>
            <pre class="profile-userpost-text"><?= htmlspecialchars($r["text"]); ?></pre>
            <? if( !empty($r['file_name']) ){ ?>
                <img class="profile-userpost-image" src="<?= $r['file_name']; ?>"  onerror="this.onerror=null;this.src=&#34;uploads/avatars/default.jpg&#34;;">
            <? } ?>
        </div>
        <?if($user){ ?>
            <div class="profile-userpost-delete-form">
                <form method="post" action="profile">
                    <input id="fileId" name="fileId" type="hidden" value="<?= $r['file_id']; ?>">
                    <input name="delete_post" type="submit" class="button" value="Delete">
                </form>
            </div>
        <? }
    }
    ?>
</div>