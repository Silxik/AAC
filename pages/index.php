<?
$q = $db->query("SELECT * FROM userpost U INNER JOIN user US ON US.user_id = U.user_id ORDER BY post_date DESC");
?>

<div class="errorlog"></div>
<div id="index" class="main-block">
    <h2 class="header-h1">Welcome to Anime Addicts Continue!</h2>

    <p>This site is currently under developement. Please stay in tune for further information!</p>

    <? if ($user) { ?>
        <form id="userPost" class="profile-form" method="POST" action="system/update" enctype="multipart/form-data">
            <div class="user-icon-container user-item-icon small new-discussion-comment-icon"><span class="user-icon-helper"></span><img class="user-icon" src="<?= $user["profile_image"]; ?>" onerror="this.onerror=null;this.src=&#39;uploads/avatars/default.jpg&#39;;"></div>
            <textarea class="new-post-textarea" name="text" placeholder="What's on your mind?"></textarea>
            <div class="new-post-image-selection button" title="Choose attachment..."><i class="fa fa-paperclip" aria-hidden="true"></i></div>
            <input class="button new-post-submit" type="submit" name="newPost" value="Post">
            <input class="hidden" style="color:white;" id="post_attachment" name="post_attachment" type="file">
            <div class="preview-container">
                <img class="image-preview"/>
            </div>
        </form>
    <? } ?>

        <script>

            /* REALTIME FIREBASE POST COMMENT
            ** ========================================================================== */
            var curDate = new Date().toLocaleString();

            // CREATE A REFERENCE TO FIREBASE
            var postsRef = new Firebase('https://aac-posts.firebaseio.com/');

            var postsField = $('.new-post-comment-textarea');
            $(document).on('keypress', '.new-post-comment-submit.button', function(e){
                var keyCode = e.keyCode || e.which;

                if (keyCode == 13) {
                    var post_id = $(this).data('id');

                    //FIELD VALUES
                    var comment_author = "<?= $user['username']; ?>";
                    var comment_message = $(this).parent().find(".new-post-comment-textarea").val();
                    var curDate = new Date().toLocaleString();

                    //SAVE DATA TO FIREBASE AND EMPTY FIELD
                    postsRef.child(post_id).push({name:comment_author, text:comment_message, date:curDate});
                    postsField.val('');
                }
            }).on('click', '.new-post-comment-submit.button', function(){
                var post_id = $(this).data('id');

                //FIELD VALUES
                var comment_author = "<?= $user['username']; ?>";
                var comment_message = $(this).parent().find(".new-post-comment-textarea").val();
                var curDate = new Date().toLocaleString();

                //SAVE DATA TO FIREBASE AND EMPTY FIELD
                postsRef.child(post_id).push({name:comment_author, text:comment_message, date:curDate});
                postsField.val('');
            });

            
        </script>
    <? while ($r = $q->fetch_assoc()) { ?>
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

            <div class="post-comments-block">
            <? if($user) { ?>
                <div class="new-post-comment-block">
                    <div class="user-icon-container user-item-icon small new-discussion-comment-icon"><span class="user-icon-helper"></span><img class="user-icon" src="<?= $user["profile_image"]; ?>" onerror="this.onerror=null;this.src=&#39;uploads/avatars/default.jpg&#39;;"></div>
                    <textarea class="new-post-comment-textarea" name="text" placeholder="What's on your mind?"></textarea>
                    <input class="button new-post-comment-submit" data-id="<?=$r['post_id'];?>" type="submit" name="newPost" value="Post">
                </div>
            <? } ?>

                <div class="post-comments-container" data-id="<?=$r['post_id'];?>"></div>
            </div>
        </div>
    <? } ?>
</div>

<script>
    var post_ids = [];
    <? $sql = $db->query('SELECT post_id FROM userpost');
    while( $query = $sql->fetch_assoc() ){ ?>
        post_ids.push('<?= $query['post_id']; ?>');
    <? } ?>

    //TIME INTERVAL FOR COMMENT UPLOADING TO SERVER FROM FIREBASE
    var counter = 0;
    var i = setInterval(function(){
        if( post_ids.length < 1 ) {
            clearInterval(i);
        } else {
            var post_id = post_ids[counter];
            // Add a callback that is triggered for each post message.
            postsRef.child(post_id).limitToLast(50).on('child_added', function (snapshot) {
                var postsList = $('.post-comments-container[data-id="'+post_id+'"]');

                //GET DATA
                var data = snapshot.val();
                var comment_author = data.name;
                var comment_message = data.text;
                var date = data.date;

                var pos = $.inArray(comment_author, uNames);

                //CREATE ELEMENTS MESSAGE & SANITIZE TEXT
                var messageBlock = $('<div class="post-comment">');
                var messageElement = $('<div class="post-comment-text"></div>');
                var userElement = $('<div class="post-comment-username user-link"></div>')
                var dateElement = $('<div class="post-comment-date"></div>');
                var iconElement = $('<div class="user-icon-container user-item-icon small post-comment-icon"><span class="user-icon-helper"></span><img class="user-icon" src="'+ uImages[pos] +'"  onerror="this.onerror=null;this.src=&#34;uploads/avatars/default.jpg&#34;;">');
                var mediumIcon = $('<div class="user-icon-container comment-infobox-icon"><span class="user-icon-helper"></span><img class="user-icon" src="'+ uImages[pos] +'"  onerror="this.onerror=null;this.src=&#34;uploads/avatars/default.jpg&#34;;">');
                iconElement.attr('title',comment_author + ', ' + date);

                messageElement.text(comment_message);
                userElement.text(comment_author);

                //MONTH NAME FROM NUMBER
                var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                var date = date.split(" ")[0].split(".")[0] + ' ' + monthNames[date.split(" ")[0].split(".")[1] - 1] + ' ' + date.split(" ")[0].split(".")[2] + ' at ' + date.split(" ")[1].split(".")[0];
                dateElement.text('Posted ' + date);

                var infoboxText = $('<div class="comment-infobox-text">').append(userElement).append(dateElement);
                var infobox = $('<div class="infobox">').append(mediumIcon).append(infoboxText);

                messageBlock.append(iconElement).append(infobox).append(messageElement);

                //ADD MESSAGE
                postsList.prepend(messageBlock);

                //SCROLL TO BOTTOM OF MESSAGE LIST
                postsList[0].scrollTop = postsList[0].scrollHeight;
            });

            counter++;
            if( counter === (post_ids.length)) {
                clearInterval(i);
            }
        }
    }, 400);
</script>