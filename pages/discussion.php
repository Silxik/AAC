<div class="errorlog"></div>

<div class="discussion-block">
    <? if( isset($_GET['id']) ){
        $id = $db->real_escape_string($_GET['id']);
        $sql = $db->query("SELECT * FROM discussion D INNER JOIN user U ON D.user_id=U.user_id WHERE discussion_id='$id'");
        if (mysqli_num_rows($sql) > 0) {
            if ($result = $sql->fetch_assoc()) { ?>

                <div class="discussion-container">
                    <? if (!empty($result['file_name'])) { ?>
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
                <div class="discussion-comment-block">
                <? if($user) { ?>
                    <div class="new-discussion-comment">
                        <div class="user-icon-container user-item-icon small new-discussion-comment-icon"><span class="user-icon-helper"></span><img class="user-icon" src="<?= $user["profile_image"]; ?>" onerror="this.onerror=null;this.src=&#39;uploads/avatars/default.jpg&#39;;"></div>
                        <textarea class="discussion-message-input" placeholder="Leave a comment..."></textarea>
                        <div class="discussion-comment-post button"><i class="fa fa-arrow-right" aria-hidden="true"></i></div>
                    </div>
                <? } ?>

                    <div class="discussion-comments-container"></div>
                </div>

                <script>

                    /* REALTIME FIREBASE DISCUSSION COMMENT
                    ** ========================================================================== */
                    var curDate = new Date().toLocaleString();
                    var discussion_id = "<?=$_GET['id'];?>";

                    // CREATE A REFERENCE TO FIREBASE
                    var discussionRef = new Firebase('https://aac-discussion.firebaseio.com/');

                    // REGISTER DOM ELEMENTS
                    var discussionField = $('.discussion-message-input');
                    var discussionList = $('.discussion-comments-container');

                    // LISTEN FOR ELEMENT CLICK
                    $(document).on('click', '.discussion-comment-post.button', function(){
                        //FIELD VALUES
                        var comment_author = "<?= $user['username']; ?>";
                        var comment_message = discussionField.val();
                        var curDate = new Date().toLocaleString();

                        //SAVE DATA TO FIREBASE AND EMPTY FIELD
                        discussionRef.child(discussion_id).push({name:comment_author, text:comment_message, date:curDate});
                        discussionField.val('');
                    });

                    // Add a callback that is triggered for each discussion message.
                    discussionRef.child(discussion_id).limitToLast(50).on('child_added', function (snapshot) {
                        //GET DATA
                        var data = snapshot.val();
                        var comment_author = data.name;
                        var comment_message = data.text;
                        var date = data.date;

                        var pos = $.inArray(comment_author, uNames);

                        //CREATE ELEMENTS MESSAGE & SANITIZE TEXT
                        var messageBlock = $('<div class="discussion-comment">');
                        var messageElement = $('<div class="discussion-comment-text"></div>');
                        var userElement = $('<div class="discussion-comment-username user-link"></div>')
                        var dateElement = $('<div class="discussion-comment-date"></div>');
                        var iconElement = $('<div class="user-icon-container discussion-icon"><span class="user-icon-helper"></span><img class="user-icon" src="'+ uImages[pos] +'"  onerror="this.onerror=null;this.src=&#34;uploads/avatars/default.jpg&#34;;">');
                        iconElement.attr('title',comment_author + ', ' + date);

                        messageElement.text(comment_message);
                        userElement.text(comment_author);

                        //MONTH NAME FROM NUMBER
                        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                        var date = date.split(" ")[0].split(".")[0] + ' ' + monthNames[date.split(" ")[0].split(".")[1] - 1] + ' ' + date.split(" ")[0].split(".")[2] + ' at ' + date.split(" ")[1].split(".")[0];
                        dateElement.text('Posted ' + date);

                        var col1 = $('<div class="discussion-comment-col-1">').append(userElement).append(iconElement);
                        var col2 = $('<div class="discussion-comment-col-2">').append(dateElement).append(messageElement);

                        messageBlock.append(col1).append(col2).append('<div class="clearfix"></div>');

                        //ADD MESSAGE
                        discussionList.prepend(messageBlock);

                        //SCROLL TO BOTTOM OF MESSAGE LIST
                        discussionList[0].scrollTop = discussionList[0].scrollHeight;
                    });
                </script>

            <? }
        } else { ?>
            <script> window.location.href = window.location.href.split(window.location.search)[0] </script>
        <? }
    } else { ?>

    <? if ($user) { ?>
        <h1 class="header-h1">Discussions</h1>
        
        <div class="new-discussion-block">
            <form id="new-discussion" method="POST" action="upload" enctype="multipart/form-data">
                <div>
                    <label class="form-label in-line">Title: </label>
                    <input class="new-discussion-title" name="title" type="text" placeholder="Title...">
                </div>
                <div>
                    <label class="form-label in-line text-area-label">Your discussion:</label>
                    <textarea class="new-discussion-description text-area" placeholder="Description..." name="text"></textarea>
                </div>
                <div>
                    <label class="form-label in-line"></label>
                    <div class="new-discussion-image-selection button" title="Choose attachment...">
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                    </div>
                    <input class="hidden" id="file" name="new-discussion-image" type="file">
                    <input class="button new-discussion-submit" name="new-discussion" type="submit" value="Create">
                </div>
                <div>
                    <label class="form-label in-line"></label>
                    <div class="preview-container">
                        <img class="image-preview"/>
                    </div>
                </div>
            </form>
        </div>
    <? } ?>
    
    <div class="discussion-block">
    <?
    $sql = $db->query("SELECT * FROM discussion D INNER JOIN user U ON D.user_id=U.user_id ORDER BY date DESC");
    while ($discussion = $sql->fetch_assoc() ) { ?>
        <div class="discussion-container">
            <? if (!empty($discussion['file_name'])) { ?>
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