<?php
include('secret/dbconnect.php');
$query = file_get_contents(string $filename);

$b=Array("news(what varchar(512),born date)",
    "users(user varchar(32),pass varchar(32),ip varchar(32),mail varchar(128),last date,born date)",
    "serv(user varchar(32),what varchar(32),max int(32),ip varchar(32),last date,born date)",
    "forum(id int(8),user varchar(32),what varchar(32),hits int(32),reps varchar(32),born date)",
    "posts(id int(8),user varchar(32),what varchar(512),born date)",
    "log(what varchar(512),born date)");
foreach($b as $c){mysqli_query("CREATE TABLE IF NOT EXISTS ".$c);}
?>