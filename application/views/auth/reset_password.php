<div class="container">
	<div class="text-center row justify-content-center">
		<div class="col-md-6">
			<h1><?php echo lang('reset_password_heading'); ?></h1>

			<?php echo form_open('auth/reset_password/' . $code); ?>

			<div class="md-form">
				<label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length); ?></label> <br />
				<?php echo form_input($new_password, '', 'class="form-control" placeholder="Masukan Password Baru" required autofocus'); ?>
			</div>

			<div class="md-form">
				<?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm'); ?> <br />
				<?php echo form_input($new_password_confirm, '', 'class="form-control" placeholder="Masukan Password Baru" required'); ?>
			</div>

			<?php echo form_input($user_id); ?>
			<?php echo form_hidden($csrf); ?>

			<p><?php echo form_submit('submit', lang('reset_password_submit_btn')); ?></p>

			<?php echo form_close(); ?>
		</div>
	</div>