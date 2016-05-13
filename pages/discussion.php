<div class="errorlog"></div>

<div class="discussion-block">
    <? if( isset($_GET['id']) ){
        $id = $db->real_escape_string($_GET['id']);
        $sql = $db->query("SELECT * FROM discussion D INNER JOIN files F ON D.file_id = F.file_id INNER JOIN user U ON D.user_id=U.user_id WHERE discussion_id='$id'");
        if (mysqli_num_rows($sql) > 0) {
            if ($result = $sql->fetch_assoc()) { ?>

                <div class="discussion-container">
                    <? if ($result['file_id'] !== 0) { ?>
                        <img class="discussion-image-full" src="<?= $result['file_name']; ?>" alt="Discussion image">
                    <? } ?>
                    <div class="discussion-header">
                        <h1 class="discussion-title"><?= htmlspecialchars($result["title"]); ?></h1>
                        <p class="discussion-header-text">By <a class="user-link"><?= $result['username']; ?></a></p>
                        <span class="disussion-date">Created <?= $result["date"]; ?></span>
                    </div>
                    <p class="discussion-container-text"><?= htmlspecialchars($result['text']); ?></p>
                    <div class="clearfix"></div>
                </div>

            <? }
        } else {
            header('location: 404');
        }
    } else { ?>

    <? if ($user) { ?>
        <div class="new-discussion-block">
            <h1 class="header-h1">Discussions</h1>
            <form id="new-discussion" method="POST" action="upload" enctype="multipart/form-data">
                <div>
                    <label class="form-label in-line" for="title">Title: </label><input class="new-discussion-title" name="title" type="text" placeholder="Title...">
                </div>
                <div>
                    <label class="form-label in-line text-area-label" for="text">Your discussion:</label><textarea class="new-discussion-description text-area" placeholder="Description..." name="text"></textarea>
                </div>
                <div>
                    <label class="form-label in-line" for="disc_img_prev" class="br">Upload image: </label><input id="file" name="new-discussion-image" type="file">
                    <div class="preview-container">
                        <img class="image-preview"/>
                    </div>
                </div>
                    <div><label class="form-label in-line text-area-label" for="text"></label><input class="button" name="new-discussion" type="submit"></div>
            </form>
        </div>
    <? } ?>
    
    <div class="discussion-block">
    <?
    $sql = $db->query("SELECT * FROM discussion D INNER JOIN files F ON D.file_id = F.file_id INNER JOIN user U ON D.user_id=U.user_id ORDER BY date DESC");
    while ($discussion = $sql->fetch_assoc() ) { ?>
        <div class="discussion-container">
            <? if ($discussion['file_id'] !== 0) { ?>
                <img class="discussion-image" src="<?= $discussion['file_name']; ?>" rel="Discussion image">
            <? } ?>

            <div class="discussion-header">
                <h2 class="discussion-title discussion-toggler" data-id="<?= $discussion['discussion_id']; ?>"><?= htmlspecialchars($discussion["title"]); ?></h2>
                <p class="discussion-header-text">By <a class="user-link"><?= $discussion['username']; ?></a> <span class="discussion-date"><?= $discussion["date"]; ?></span></p>
            </div>
        </div>
    <? } ?>
    </div>
    <? } ?>
</div>