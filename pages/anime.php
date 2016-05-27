<?
$sql = $db->query("SELECT * FROM top_anime_selection ORDER BY selection_id DESC");
$user_id = $user['user_id'];
$update_sql = $db->query("SELECT * FROM user_top_selection WHERE user_id = '$user_id' AND selection_id = '1' ");
?>
<div class="errorlog"></div>
<div class="anime-block">
    <h1 class="header-h1">Top Anime Selection</h1>

	<? if($user) { ?>
	<div class="new_selection">
		<form id="animeSelectionForm" method="" action="">
			<p>Please share your 10 most favourite anime of the month separated by comma.</p>
			<p>At the end of the month a list will be created of 10 top chosen anime to give a review about outcoming or still-popular anime.</p>
			<label class="form-label in-line">Anime list: </label>
			<input type="hidden" name="top-anime-selection">
			<input type="hidden" name="selection_id" value="1">
			<textarea class="anime-selection-list textarea" name="anime-selection-list" placeholder="Write a list..."><? if($r = $update_sql->fetch_assoc()) { echo $r['anime_list']; } ?></textarea>
		
			<input class="button anime-selection-submit" type="submit">
		
		</form>
	</div>
	<? } ?>

	<div class="previous-selections-block">
		<? 
		if ( mysqli_num_rows($sql) < 1 ) { ?>
			<h3>There are currently no lists created yet.</h3>
		<? } else {
			while ( $r = $sql->fetch_assoc() ) { ?>
				<div class="selection-list">
					<div class="selection-date"><?=$r['date'];?></div>
				</div>
			<? }
		} ?>
	</div>
</div>