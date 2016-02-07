<? require_once('main.php');
$discussion_name = $db->real_escape_string($_POST['discussion_name']);
$username = $db->real_escape_string($_POST['username']);

$sql = $db->query("SELECT * FROM discussion D INNER JOIN files F ON D.file_id = F.file_id INNER JOIN user U ON D.user_id=U.user_id WHERE username='$username' AND title='$discussion_name'");

if (mysqli_num_rows($sql) > 0) {
    if ($result = $sql->fetch_assoc()) { ?>

        <div class="discussion">
            <? if ($result['file_id'] !== 0) { ?>
                <img class="disc-img-full" src="<?= $result['file_name']; ?>" alt="Discussion image">
            <? } ?>
            <div class="disc-name">
                <h1 class="disc-title"><?= $result["title"]; ?></h1>
                <p class="disc-user">By <a href="profile"><?= $result['username']; ?></a></p>
                <p>Created <?= $result["date"]; ?></p>
            </div>
            <p class="disc-text"><?= $result['text']; ?></p>
            <div class="clearfix"></div>
        </div>

    <? } else {
        echo 'Something went wrong at fetch';
    }
} else {
    echo 'Something went wrong at row';
}
?>
