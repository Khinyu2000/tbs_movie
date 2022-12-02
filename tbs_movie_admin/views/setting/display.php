<?php
displayPageHeader('Site Setting | ' . WEB_NAME);
displayMainNavigation('setting');
 ?>
<div class="wp-setting-container">
	<div class="wp-setting-menu">
		<div id="setting-icon-label"><i class="fas fa-cog"></i></div>
		<li class="setting-active">
			<a href="#"><i class="fas fa-key"></i>change password</a>
		</li>
		<li>
			<a href="#"><i class="fas fa-eye"></i>viewer</a>
		</li>
	</div>
	<div class="wp-setting-display">
		<div class="wp-account-container">
			<form class="wp-password-change" action="<?php echo URL ?>/setting/change_account/" method="post">
				<div class="wp-current-account-container">
					<div class="current-label"><span id="current-block"></span>Current Account</div>
					<div class="current-input-container">
						<input type="text" name="current_username">
						<span data-placeholder="Username"></span>
					</div>
					<div class="current-input-container">
						<input type="password" name="current_password" id="account-pass">
						<span data-placeholder="Password"></span>
						<span id="account-show-pass"><i class="fas fa-eye-slash"></i></span>
					</div>
				</div>

				<div class="separator"></div>

				<div class="wp-new-account-container">
					<div class="new-label"><span id="new-block"></span>New Account</div>
					<div class="new-input-container">
						<input type="text" name="new_username">
						<span data-placeholder="Username"></span>
					</div>
					<div class="new-input-container">
						<input type="password" name="new_password1">
						<span data-placeholder="New password"></span>
					</div>
					<div class="new-input-container">
						<input type="password" name="new_password2">
						<span data-placeholder="Confirm password"></span>
					</div>
					<div class="new-button-container"><button type="submit">CHANGE</button></div>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="<?php echo FILE_URL ?>/scripts/setting.js"></script>
 <?php
displayPageFooter();
  ?>
