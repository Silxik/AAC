<?
/**
 * Created by PhpStorm.
 * User: Andres
 * Date: 24.02.2016
 * Time: 15:43
 */
include_once("main.php");

$path = pathinfo($_SERVER["REQUEST_URI"])["filename"];
if($path === "profile"){
    if(isset($_POST["user-link"])){
        $username = $_POST["username"];

        // If page is visited by owner, create admin panel, else show design
        if($username === $user["username"]){ ?>
            <div class="user-admin-block">
                <div class="user-admin-container">
                    <div class="user-admin-header">
                        <h3 class="header-h3">Welcome, <?=$user["username"];?></h3>
                    </div>
                    <div class="user-admin-nav">
                        <ul class="user-admin-nav-list">
                            <li class="user-admin-nav-item"><a class="user-admin-nav-link">Item-1</a></li>
                            <li class="user-admin-nav-item"><a class="user-admin-nav-link">Item-2</a></li>
                            <li class="user-admin-nav-item"><a class="user-admin-nav-link">Item-3</a></li>
                            <li class="user-admin-nav-item"><a class="user-admin-nav-link">Item-4</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <? }else{

        }
    }
}
?>