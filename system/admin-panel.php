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

        // If page is visited by owner, create admin panel, else show design
        if($username === $user["username"]){
            ?>
            <div class="sidebar-toggle button show">Show panel</div>
            <div class="admin-block">
                <div class="admin-container">
                    <div class="sidebar-toggle button hide">Hide panel</div>
                    <div class="admin-header">
                        <h3 class="header-h3">Welcome, <?=$user["username"];?></h3>
                    </div>
                    <div class="admin-nav">
                        <ul class="admin-nav-list">
                            <li class="admin-nav-item">
                                <a class="admin-nav-link">Background</a>
                                <div class="admin-editable">
                                    <form method="post" action="" autocomplete="off">
                                        <label>Choose new background image :</label>
                                        <input id="file" type="file">
                                        <div class="preview-container">
                                            <img class="image-preview">
                                        </div>

                                        <input type="radio" value> <!-- TODO BACKGROUND POSITION, CONTAINER COLOR CHANGES -->
                                    </form>
                                </div>
                            </li>
                            <li class="admin-nav-item"><a class="admin-nav-link">Code editor</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function(){
                    $(".admin-block").addClass("show");
                    $(".main-page-block").addClass("move");
                });

                $("#file").change(function(){
                    setTimeout(function(){
                        if( $("style").length > 1 ) {
                            $("style").last().remove();
                            $("body").append('<style> body{ background-image:url('+ $(".image-preview").attr("src") +'); } </style>');
                        } else {
                            $("body").append('<style> body{ background-image:url('+ $(".image-preview").attr("src") +'); } </style>');
                        }
                    }
                    ,1000);
                });
            </script>

            <!-- TODO INSERT INTO DATABASE USERPROFILE -->
        <? }else{

        }
    } elseif ( $user ) {
        $username = $user["username"];
        $q = $db->query("SELECT * FROM userpost U INNER JOIN files F ON U.file_id = F.file_id INNER JOIN user US ON US.user_id = U.user_id WHERE US.username = '$username' ORDER BY post_date DESC");
    } else {
        header("location:". BASE_URL);
    }
}
?>