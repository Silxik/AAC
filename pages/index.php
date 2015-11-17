<div class="index">
    <h1>Hi <? if ($user) {
        echo stripslashes($user['username']);
    }; ?>!</h1>

        <h2>Welcome to Anime Addicts Continue!</h2>

    <p>This site is currently under developement. Please stay in tune for further information!</p>
    <pre>
        Kasutaja 1
        Kasutajanimi: Kurikutsu
        Parool: Proov
    </pre>

    <?
    $r = $db->query("SELECT * FROM userpost U INNER JOIN files F ON U.file_id = F.file_id INNER JOIN user US ON US.user_id = U.user_id");
    while($post_q = $r->fetch_assoc()){
        echo '<div class="post"><span class="icon small" style="background-image:url('. '\'' . $post_q["profile_image"]. '\'' .')"></span><p class="post_username">'. $post_q["username"] .'</p><small class="post_date">' . $post_q["post_date"] . '</small><pre>' . $post_q["text"] . '</pre>';
        if($post_q['file_name'] !== ''){
            echo '<img class="postImg br" src="' . $post_q['file_name'] . '">';
        }
        echo '</div>';
    }
    ?>
</div>