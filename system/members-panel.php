<div class='users-block'>
	<? if($user){ ?>

	<ul class='users-list'>
		<? foreach ($users as $useritems) { ?>
			<li class='user-items'>
				<img class="user-item-icon user-icon small vertical-align" src="<?= $useritems["profile_image"]; ?>" onerror="this.onerror=null;this.src=&#39;uploads/avatars/default.jpg&#39;;">
				<span class="user-item-username vertical-align"><?= $useritems['username'] ?></span>
			</li>
		<? } ?>
	</ul>

	<? } else {
		echo 'Please log in first!';
	} ?>
</div>