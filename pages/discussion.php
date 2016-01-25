<div class="new_disc">
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
<?
$disc_q = $db->query("SELECT * FROM discussion D INNER JOIN files F ON D.file_id = F.file_id");
while ($disc_res = $disc_q->fetch_assoc()) { ?>
    <div class="discussion">
        <? if ($disc_res['file_id'] !== 0) { ?>
            <span class="disc_img" style="background-image:url('<?= $disc_res["file_name"]; ?>')"></span>
        <? } ?>

        <div class="disc_name">
            <h2 class="disc_title"><?= $disc_res["title"]; ?></h2>
            <p><?= $disc_res["date"]; ?></p>
        </div>
        <pre class="disc_text"><?= $disc_res["text"]; ?></pre>

        <div class="comment">
            <?
            $disc_id = $disc_res['discussion_id'];
            $disc_comments = $db->query("SELECT * FROM discussion_comments DC INNER JOIN user U ON DC.user_id = U.user_id WHERE discussion_id = '$disc_id'");
            foreach ($disc_comments as $disc_comment) { ?>
                <p><?= $disc_comment['date']; ?></p>
                <a href="#"><?= $disc_comment['username']; ?></a>
                <pre><?= $disc_comment['text']; ?></pre>
            <? } ?>
        </div>

        <? if ($user) { ?>
            <div id="discussion_comment">
                <form method="POST" action="upload">
                    <input type="hidden" name="user_id" value="<?= $user['user_id']; ?>">
                    <input type="hidden" name="discussion_id" value="<?= $disc_res['discussion_id']; ?>">
                    <label class="br" for="comment">Comment:</label><textarea name="comment"
                                                                              placeholder="Comment..."></textarea>
                    <input type="submit" name="discussion_comment" class="button br">
                </form>
            </div>
        <? } ?>
    </div>
<? } ?>

<script>
    $('.disc_title').click(function () {
        $('.discussion').eq($(this).parent().parent().index() - 1).addClass('active');
        if ($('.discussion').hasClass('active')) {
            $('.discussion').css('display', 'none');
            $('.new_disc').animate({height: 'toggle'});
            $('.discussion.active').css('display', 'block');
            $('.disc_text, #discussion_comment_form').eq($(this).parent().parent().index() - 1).fadeIn();
            $('.discussion').prepend('<span class="close">Back</span>');
            $('.close').click(function () {
                $('.new_disc').animate({height: 'toggle'});
                $('.disc_text').css('display', 'none');
                $('.discussion.active').removeClass('active');
                $('.discussion').css('display', 'block');
                $('.close').remove();
            });
        } else {
            $('.discussion').eq($(this).parent().parent().index() - 1).addClass('active');
        }
    });
</script>