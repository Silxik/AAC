<div class="new_disc">
    <h1>Discussions</h1>
    <form method="POST" action="upload" enctype="multipart/form-data">
        <label class="br" for="title">Title : </label><input name="title" type="text" placeholder="Title...">
        <label class="br" for="text">Your discussion :</label><textarea placeholder="Description..." name="text"></textarea>
        <label class="br" for="disc_img_prev" class="br">Upload image : </label><input id="disc_img_file" name="disc_img" type="file">
        <div id="disc-up-prev">
            <img id="disc_img"/>
        </div>
        <input class="button" name="disc_submit" type="submit">
    </form>
</div>
<?
$disc_q = $db->query("SELECT * FROM discussion D INNER JOIN files F ON D.file_id = F.file_id");
while($disc_res = $disc_q->fetch_assoc()){
    echo '<div class="discussion">';
    if($disc_res['file_name'] !== ''){
        echo '<span class="disc_img" style="background-image:url('. $disc_res["file_name"] .')"></span>';
    }
    echo '<div class="disc_name"><h2 class="disc_title">'. $disc_res["title"].'</h2><p>'. $disc_res["text"] .'</p><p>'. $disc_res["date"] .'</p></div></div>';
}
?>