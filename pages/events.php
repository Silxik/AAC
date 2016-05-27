<div class="errorlog"></div>
<div class="events-block">
	<? if( isset($_GET['id']) ){
        $id = $db->real_escape_string($_GET['id']);
        $sql = $db->query("SELECT * FROM events E WHERE event_id='$id'");
        if (mysqli_num_rows($sql) > 0) {
            if ($result = $sql->fetch_assoc()) { ?>

                <div class="event-container">
                    <? if (!empty($result['image'])) { ?>
                        <img class="event-image-full" src="<?= $result['image']; ?>" alt="Discussion image">
                    <? } ?>
                    <div class="event-header">
                        <h1 class="event-title"><?= htmlspecialchars($result["name"]); ?></h1>
                        <span class="event-date">Created <?= $result["date_added"]; ?></span>
                    </div>
                    <p class="event-container-text"><?= htmlspecialchars($result['description']); ?></p>

                    <div class="event-participation-container">
                    	<form id="newParticipant" method="post" action="system/update.php">
                    		<div>
			                    <label class="form-label in-line">Work name: </label>
			                    <input class="new-participant-work-name" name="name" type="text" placeholder="Work name...">
			                </div>

			                <div>
			                    <label class="form-label in-line"></label>
			                    <div class="custom-image-selection button" title="Choose attachment...">
			                        <i class="fa fa-paperclip" aria-hidden="true"></i>
			                    </div>
			                    <input type="hidden" name="event_id" value="<?=$id;?>">
			                    <input class="hidden" id="file" name="new-participant-work-image" type="file">
			                    <input class="button new-participant-submit" name="new-participant" type="submit" value="Submit">
			                </div>
			                
			                <div>
			                    <div class="preview-container">
			                    	<label class="form-label in-line"></label>
			                        <img class="image-preview"/>
			                    </div>
			                </div>
                    	</form>
                    </div>

                    <div class="clearfix"></div>
                </div>

                <div class="event-participants-container">
                	<?
                	$monthNames = [
			    		"January", "February", "March", 
			    		"April", "May", "June", 
			    		"July", "August", "September", 
			    		"October", "November", "December"
		    		];

                	$sql = $db->query("SELECT U.username, E.name, EP.file, EP.date_added FROM event_participants EP INNER JOIN events E ON EP.event_id = E.event_id INNER JOIN user U ON EP.user_id = U.user_id WHERE EP.event_id = '$id'");

                	if( mysqli_num_rows($sql) > 0 ) {
                		while($r = $sql->fetch_assoc()) { 
                			$date = explode("-" ,explode(" ", $r["date_added"])[0])[2] . " " . $monthNames[explode("-" ,explode(" ", $r["date_added"])[0])[1] - 1] . " " . explode("-" ,explode(" ", $r["date_added"])[0])[0] . " at " . explode(":", explode(" ", $r["date_added"])[1])[0] . ':' . explode(":", explode(" ", $r["date_added"])[1])[1];
                			$work = explode(".", explode("/", $r['file'])[2])[0];
                			?>

                			<div class="event-participant">
                				<div class="participant-image-container"><img class="participant-image" title="<?=$work;?>" src="<?=$r['file'];?>" alt="<?=$work;?>"></div>
                				<div class="participant-name user-link">Posted by <?=$r['username'];?></div>
                				<div class="participant-date"><?=$date;?></div>
                			</div>
            			<? }
                	}
                	?>
                </div>
            <? }
        } else { ?>
            <script> window.location.href = window.location.href.split(window.location.search)[0] </script>
        <? }
    } else { ?>

	    <h1 class="header-h1">Active events</h1>

		<? if($user && $user['username'] == "Kurikutsu" || $user && $user['username'] == "Komision" ) { ?>
	    <div class="new-event-block">
	    	<form action="system/upload.php" id="newEventForm" method="post" autocomplete="off">
	    		<div>
		    		<label class="profile-form-label in-line">Title: </label>
		    		<input class="new-event-title" type="text" name="title" placeholder="Add title...">	
	    		</div>

	    		<div>
		    		<label class="profile-form-label in-line">Description: </label>
		    		<textarea name="text" class="new-event-description textarea" placeholder="Add description..."></textarea>
	    		</div>
	    		

			    <div>
			    	<label class="profile-form-label in-line"></label>
			    	<input class="hidden" id="file" type="file" name="new-event-image" >
			    	<div class="custom-image-selection button" title="Choose attachment...">
		                <i class="fa fa-paperclip" aria-hidden="true"></i>
		            </div>
			        <input type="submit" name="new-event" value="Create" class="new-event-submit button">
			    </div>

	    		<div class="preview-container">
	                <label class="profile-form-label in-line"></label>
	                <img class="image-preview" />
	            </div>
	    	</form>
	    </div>
	    <? } ?>

	    <div class="active-events">
	    	<?
	    	$sql = $db->query("SELECT * FROM events ORDER BY date_added");
	    	if( mysqli_num_rows($sql) > 0 ) {
		    	while ( $r = $sql->fetch_assoc() ) { ?>
		    		<div class="event-container">
		    			<? if (!empty($r['image'])) { ?>
			                <img class="event-image" src="<?= $r['image']; ?>" alt="Event image">
			            <? } ?>

			            <div class="event-header">
			                <h2 class="event-title event-toggler" data-id="<?= $r['event_id']; ?>"><?= htmlspecialchars($r["name"]); ?></h2>
			                <p class="event-header-text"><span class="event-date"><?= $r["date_added"]; ?></span></p>
			            </div>
		    		</div>
				<? } 
			} else { ?>
				<h3>There are currently no active events. Please stay in tune for event updates at homepage.</h3>
			<? } ?>
	    </div>
	<? } ?>
</div>