    <form method="POST" action="upload" enctype="multipart/form-data">
        <label class="br" for="text"></label><textarea name="text" placeholder="What's on your mind?"></textarea>
        <label class="br" for="post_attachment">Choose file : </label><input style="color:white;" name="post_attachment" type="file">
        <input type="hidden" name="id" value="<? echo $user['id']; ?>">
        <input class="button br" type="submit" name="newPost" value="Post">
    </form>


    <?
    /*
    $sql = "SELECT text, post_attachment FROM userpost";
    $q = $db->query($sql);
    while ($r = $q->fetch_assoc()) {
        echo '<div class="post"><small>' . $r["post_date"] . '</small><pre>' . $r["text"] . '</pre><img class="postImg br" src="' . $r['postImage'] . '"></div>';
    }
    */
    ?>