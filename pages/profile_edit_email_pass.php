<div class="errorlog"></div>

<div class="profile-edit-block">
	<div class="profile-edit-pass">
		<h2 class="profile-edit-header">Change Password</h2>
		<form id="pass-update" class="profile-edit-form" action="" method="post" autocomplete="off">
			<input name="userID" type="hidden" value="<?= $user['user_id']; ?>">
			<input name="passUpdate" type="hidden" value="">
			<div><label class="profile-form-label in-line">Current password:</label><input class="profile-edit-input curPass" name="curPass" type="password" placeholder="Current password..."></div>
			<div><label class="profile-form-label in-line">NEW password:</label><input class="profile-edit-input newPass" name="newPass" type="password" placeholder="New password..."></div>
			<div><label class="profile-form-label in-line">Confirm new password:</label ><input class="profile-edit-input confirm" name="confirm" type="password" placeholder="New password again..."></div>
			<div><label class="profile-form-label in-line"></label><input class="button" type="submit"></div>
		</form>
	</div>

	<div class="profile-edit-email">
		<h2 class="profile-edit-header">Change email</h2>
		<form id="mail-update" class="profile-edit-form" action="" method="post" autocomplete="off">
			<input name="userID" type="hidden" value="<?= $user['user_id']; ?>">
			<input name="mailUpdate" type="hidden" value="">
			<div><label class="profile-form-label in-line">Current email:</label><strong><?= ( !empty($user['email']) ? $user['email'] : 'No email set!' )?></strong></div>
			<div><label class="profile-form-label in-line">Current password:</label><input class="profile-edit-input curPass" name="curPass" type="password" placeholder="Current password..."></div>
			<div><label class="profile-form-label in-line">New email:</label><input class="profile-edit-input newMail" name="newMail" type="text" placeholder="New email..."></div>
			<div><label class="profile-form-label in-line text-area-label"></label><input type="submit" class="button"></div>
		</form>
	</div>
</div>
