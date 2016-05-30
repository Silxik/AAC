<div class='users-block'>
	<? if($user){ ?>

	<ul class='users-list'>
		<? foreach ($users as $useritems) { ?>
			<li class='user-items'>
				<div class="user-icon-container user-item-icon small"><span class="user-icon-helper"></span><img class="user-icon" src="<?= $useritems["profile_image"]; ?>" onerror="this.onerror=null;this.src=&#39;uploads/avatars/default.jpg&#39;;" alt="User icon"></div>
				<span class="user-item-username vertical-align"><?= $useritems['username'] ?></span>
			</li>
		<? } ?>
	</ul>

	<? } else {
		echo "<h3 class='login-header'>Please log in first!</h3>";
	} ?>
</div>