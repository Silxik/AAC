<div id="index" class="main-block">
    <h1 class="header-h1">Hi <? if ($user) {
        echo stripslashes($user['username']);
    }; ?>!</h1>

        <h2>Welcome to Anime Addicts Continue!</h2>

    <p>This site is currently under developement. Please stay in tune for further information!</p>
    <pre>
        Kasutaja 1
        Kasutajanimi: Kurikutsu
        Parool: Proov
    </pre>

    <?
    $q = $db->query("SELECT * FROM userpost U INNER JOIN files F ON U.file_id = F.file_id INNER JOIN user US ON US.user_id = U.user_id ORDER BY post_date DESC");
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