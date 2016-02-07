<div class="new-disc">
    <h1>Discussions</h1>
    <form method="POST" action="upload" enctype="multipart/form-data">
        <label class="br" for="title">Title : </label><input name="title" type="text" placeholder="Title...">
        <label class="br" for="text">Your discussion :</label><textarea placeholder="Description..." name="text"></textarea>
        <label class="br" for="disc_img_prev" class="br">Upload image : </label><input id="file" name="disc_img" type="file">
        <div id="preview_container">
            <img id="prev"/>
        </div>
        <? if ($user) { ?>
            <input class="button" name="disc_submit" type="submit">
        <? } else { ?>
            <p>To create a discussion you must be logged in first!</p>
        <? } ?>
    </form>
</div>
<div class="discussions">
<?
$disc_q = $db->query("SELECT * FROM discussion D INNER JOIN files F ON D.file_id = F.file_id INNER JOIN user U ON D.user_id=U.user_id");
while ($disc_res = $disc_q->fetch_assoc()) { ?>
    <div class="discussion">
        <? if ($disc_res['file_id'] !== 0) { ?>
            <img class="disc-img" src="<?= $disc_res['file_name']; ?>" rel="Discussion image">
        <? } ?>

        <div class="disc-name">
            <h2 class="disc-title"><?= $disc_res["title"]; ?></h2>
            <p class="disc-user">By <a href="profile"><?= $disc_res['username']; ?></a> at <?= $disc_res["date"]; ?></p>
        </div>
    </div>
<? } ?>
</div>
<script>
    $('.disc-title').click(function () {
        var discussion_name = $(this).text();
        var username = $('#main .discussion .disc-name .disc-user a').eq($(this).parent().parent().parent().index()).text();
        $.ajax({
            url: 'system/ajax_discussion.php',
            data: {username: username, discussion_name: discussion_name},
            type: 'POST',
            success: function (data) {
                $('#main').html(data);
            }
        });
    });
</script>