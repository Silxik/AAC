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

            <? } else {
                echo 'There is no discussion with such id.';
            }
        } else {
            header('location: 404');
        }
    } else { ?>

    <div class="discussion-create-block">
        <h1 class="header-h1">Discussions</h1>
        <form method="POST" action="upload" enctype="multipart/form-data">
            <label class="form-label" for="title">Title : </label><input name="title" type="text" placeholder="Title...">
            <label class="form-label" for="text">Your discussion :</label><textarea placeholder="Description..." name="text"></textarea>
            <label class="form-label" for="disc_img_prev" class="br">Upload image : </label><input id="file" name="disc_img" type="file">
            <div class="preview-container">
                <img class="image-preview"/>
            </div>
            <? if ($user) { ?>
                <input class="button" name="disc_submit" type="submit">
            <? } else { ?>
                <p>To create a discussion you must be logged in first!</p>
            <? } ?>
        </form>
    </div>
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