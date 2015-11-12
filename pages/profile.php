    <div class="profile_nav">
        <div class="menu_left">
            <ul>
                <li><a>Timeline</a></li><span class="nav_line"></span>
                <li><a>About</a></li><span class="nav_line"></span>
                <li><a>Photos</a></li>
            </ul>
        </div>
        <div class="menu_right">
            <ul>
                <li><a href="profileEdit">Edit profile</a></li>
            </ul>
        </div>
    </div>

    <div class="profile_content">
        <form method="POST" action="upload" enctype="multipart/form-data">
            <label class="br" for="text"></label><textarea name="text" placeholder="What's on your mind?"></textarea>
            <label class="br" for="post_attachment">Choose file : </label><input style="color:white;" name="post_attachment" type="file">
            <input type="hidden" name="id" value="<? echo $user['user_id']; ?>">
            <input class="button br" type="submit" name="newPost" value="Post">
        </form>

        <?
        $u_id = $user['user_id'];
        $q = $db->query("SELECT * FROM userpost U INNER JOIN files F ON U.file_id = F.file_id INNER JOIN user US ON US.user_id = U.user_id WHERE U.user_id = $u_id");
        while ($r = $q->fetch_assoc()) {
            echo '<div class="post"><span class="icon small" style="background-image:url('. $r["profile_image"] .');"></span><p class="post_username">'. $r["username"] .'</p><small class="post_date">' . $r["post_date"] . '</small><pre>' . $r["text"] . '</pre>';
            if($r['file_name'] !== ''){
                echo '<img class="postImg br" src="' . $r['file_name'] . '">';
            }
            echo '</div>';
            if($user){ ?>
                <div class="del_post">
                    <form method="post" action="profile">
                        <input id="fileId" name="fileId" type="hidden" value="<?=$r['file_id'] ?>">
                        <input name="delete_post" type="submit" class="button" value="Delete">
                    </form>
                </div>
            <? }
        }
        ?>
    </div>

    <div class="profile_content">

    </div>

    <div class="profile_content">

    </div>

    <?
    if (isset($_POST['delete_post'])){
        $file_id = $db->real_escape_string($_POST['fileId']);
        $del = $db->query("DELETE FROM userpost, files USING userpost INNER JOIN files WHERE userpost.file_id = '$file_id' AND files.file_id = '$file_id'");
        if($del){
            header("location: profile");
        } else{
            exit('Mysql error: ' . $db->error);
        }
    }
    ?>