    <form method="POST" action="upload" enctype="multipart/form-data">
        <textarea name="text"></textarea>
        <input class="button" name="postImage" type="file">
        <input class="button br" type="submit" name="newPost">
    </form>

    <?
    $sql = "SELECT text, postImage FROM userpost";
    $q = $db->query($sql);
    while ($r = $q->fetch_assoc()) {
        echo '<div class="post"><small>' . $r["post_date"] . '</small><pre>' . $r["text"] . '</pre><img class="postImg br" src="' . $r['postImage'] . '"></div>';
    }
    ?>