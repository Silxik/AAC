<?
$sql = $db->query("SELECT code FROM view WHERE name='about_us' ");
?>
<div class="about-block">
	<?
		if(mysqli_num_rows($sql) > 0) {
			if($r = $sql->fetch_assoc()) {
				echo $r['code'];	
			} else {
				exit("Error occured at getting page view. ". $db->error);
			}
		} else {
			exit("This page has not been updated yet. Please stay in tune for updates at main page.");
		}
	?>
</div>