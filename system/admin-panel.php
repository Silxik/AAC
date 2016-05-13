<?
/**
 * Created by PhpStorm.
 * User: Andres
 * Date: 24.02.2016
 * Time: 15:43
 */
include_once("main.php");

$path = pathinfo($_SERVER["REQUEST_URI"])["filename"]; // URL NAME
if($path === "profile"){
    $username = "";
    if(isset($_POST["user-link"])){
        $username = $_POST["username"];
        $q = $db->query("SELECT * FROM userpost U INNER JOIN files F ON U.file_id = F.file_id INNER JOIN user US ON US.user_id = U.user_id WHERE US.username = '$username' ORDER BY post_date DESC");

        $query = $db->query("SELECT * FROM user_code WHERE user_id = (SELECT user_id FROM user WHERE username = '$username')");
        $user_profile = $query->fetch_assoc();
        // If page is visited by owner, create admin panel, else show design
        if($username === $user["username"]) {
            ?>
            <div class="sidebar-toggle button show">Show panel</div>
            <div class="admin-block">
                <div class="admin-container">
                    <div class="sidebar-toggle button hide">Hide panel</div>
                    <div class="admin-panel-error-log"></div>
                    <div class="admin-header">
                        <h3 class="header-h3">Profile editor</h3>
                    </div>
                    <div class="admin-nav">
                        <ul class="admin-nav-list">
                            <li class="admin-nav-item">
                                <a class="admin-nav-link">Change background</a>
                                <div class="admin-editable">
                                    <form id="userBackgroundEdit" method="post" action="" enctype="multipart/form-data">
                                        <label>Choose new background image :</label>
                                        <input id="file" type="file" name="user-background-image">
                                        <div class="preview-container">
                                            <img class="image-preview admin-panel-preview">
                                        </div>

                                        <input class="button" type="submit" name="user-background-edit">
                                    </form>
                                </div>
                            </li>
                            
                            <li class="admin-nav-item">
                                <a class="admin-nav-link">Change layout color</a>
                                <div class="admin-editable">
                                    <form method="post" action="">
                                        <label>Layout</label>
                                        
                                    </form>
                                </div>
                            </li>

                            <li class="admin-nav-item">
                                <a class="admin-nav-link">Code editor</a>
                                <div class="admin-editable">
                                    <form id="admin-style-editor-form" action="" method="post" >
                                        <input name="admin-editor-submit" type="hidden" value="">
                                        <label>CSS editor:</label>
                                        <textarea id="admin-style-editor" name="admin-style-editor"><?= (!empty($user_profile['css_editor'])) ? $user_profile['css_editor'] : ''; ?></textarea>
                                        <input class="button" type="submit" value="save">
                                    </form>
                                </div>
                            </li>
                            <div class="button admin-return hidden">Back</div>
                        </ul>
                    </div>
                </div>
                <div class="admin-panel-drag">
                    <span class="full-vertical-align"></span>
                    <div class="line-drag"></div>
                    <div class="line-drag"></div>
                    <div class="line-drag"></div>
                </div>
            </div>

            <script>
                $(document).ready(function(){
                    $(".admin-block").addClass("show");
                    $(".main-page-block").addClass("move");
                });

                $("#file").change(function(){
                    setTimeout(function(){
                        if( $("style").length > 2 ) {
                            $("style").last().remove();
                            $("body").append('<style> body{ background-image:url('+ $(".image-preview").attr("src") +'); } </style>');
                        } else {
                            $("body").append('<style> body{ background-image:url('+ $(".image-preview").attr("src") +'); } </style>');
                        }
                    }
                    ,1000);
                });
            </script>

            <!-- STYLE FROM TEXTAREA -->
            <style id="user-style-editor-code"><?= (!empty($user_profile['css_editor'])) ? $user_profile['css_editor'] : ''; ?></style>
            <style><?= (!empty($user_profile['bg_img'])) ? 'body { background-image: url("'.$user_profile['bg_img'].'"); }' : ''; ?></style>
        <? }else{ ?>
            <style id="user-style-editor-code">
                <?= (!empty($user_profile['css_editor'])) ? $user_profile['css_editor'] : ''; ?>
            </style>
            <style><?= (!empty($user_profile['bg_img'])) ? 'body { background-image: url("'.$user_profile['bg_img'].'"); }' : ''; ?></style>
        <? }
    } elseif ( $user ) {
        $username = $user["username"];
        $q = $db->query("SELECT * FROM userpost U INNER JOIN files F ON U.file_id = F.file_id INNER JOIN user US ON US.user_id = U.user_id WHERE US.username = '$username' ORDER BY post_date DESC");
    } else {
        header("location:". BASE_URL);
    }
}
?>