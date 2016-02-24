<div class="discussion-block">
    <div class="discussion-create-block">
        <h1 class="header-h1">Discussions</h1>
        <form method="POST" action="upload" enctype="multipart/form-data">
            <label class="form-label" for="title">Title : </label><input name="title" type="text"
                                                                         placeholder="Title...">
            <label class="form-label" for="text">Your discussion :</label><textarea placeholder="Description..."
                                                                                    name="text"></textarea>
            <label class="form-label" for="disc_img_prev" class="br">Upload image : </label><input id="file"
                                                                                                   name="disc_img"
                                                                                                   type="file">
            <div class="preview-container">
                <img id="image-preview"/>
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
        $disc_q = $db->query("SELECT * FROM discussion D INNER JOIN files F ON D.file_id = F.file_id INNER JOIN user U ON D.user_id=U.user_id");
        while ($disc_res = $disc_q->fetch_assoc()) { ?>
            <div class="discussion-container">
                <? if ($disc_res['file_id'] !== 0) { ?>
                    <img class="discussion-image" src="<?= $disc_res['file_name']; ?>" rel="Discussion image">
                <? } ?>

                <div class="discussion-header">
                    <h2 class="discussion-title"><?= $disc_res["title"]; ?></h2>
                    <p class="discussion-header-text">By <a class="user-link"><?= $disc_res['username']; ?></a> <span
                            class="discussion-date"><?= $disc_res["date"]; ?></span></p>
                </div>
            </div>
        <? } ?>
    </div>
</div>