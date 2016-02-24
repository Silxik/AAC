<? require_once('main.php');
$discussion_name = $db->real_escape_string($_POST['discussion_name']);
$username = $db->real_escape_string($_POST['username']);

$sql = $db->query("SELECT * FROM discussion D INNER JOIN files F ON D.file_id = F.file_id INNER JOIN user U ON D.user_id=U.user_id WHERE username='$username' AND title='$discussion_name'");

if (mysqli_num_rows($sql) > 0) {
    if ($result = $sql->fetch_assoc()) { ?>

        <div class="discussion-container">
            <? if ($result['file_id'] !== 0) { ?>
                <img class="discussion-image-full" src="<?= $result['file_name']; ?>" alt="Discussion image">
            <? } ?>
            <div class="discussion-header">
                <h1 class="discussion-title"><?= $result["title"]; ?></h1>
                <p class="discussion-header-text">By <a class="user-link"><?= $result['username']; ?></a></p>
                <span class="disussion-date">Created <?= $result["date"]; ?></span>
            </div>
            <p class="discussion-container-text"><?= $result['text']; ?></p>
            <div class="clearfix"></div>
        </div>

    <? } else {
        echo 'Something went wrong at fetch';
    }
} else {
    echo 'Something went wrong at row';
}
?>
