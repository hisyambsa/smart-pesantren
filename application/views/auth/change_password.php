<div class="container">
      <div class="text-center row justify-content-center">
            <div class="col-md-6">
                  <h1><?php echo lang('change_password_heading'); ?></h1>
                  <div class="text-danger" id="infoMessage"><?php echo $message; ?></div>
                  <?php echo form_open("auth/change_password"); ?>

                  <div class="md-form">
                        <?php echo lang('change_password_old_password_label', 'old'); ?>
                        <?php echo form_input($old_password, '', 'class="form-control" required autofocus'); ?>
                  </div>

                  <div class="md-form">
                        <?php echo sprintf(lang('change_password_new_password_label', 'new'), $min_password_length); ?>
                        <?php echo form_input($new_password, '', 'class="form-control" required'); ?>
                  </div>

                  <div class="md-form">
                        <?php echo lang('change_password_new_password_confirm_label', 'new_confirm'); ?>
                        <?php echo form_input($new_password_confirm, '', 'class="form-control" required'); ?>
                  </div>

                  <?php echo form_input($user_id); ?>
                  <?php
                  $attributes = array(
                        'class' => 'btn btn-danger',
                  );
                  ?>
                  <?php echo form_submit('submit', lang('change_password_submit_btn'), $attributes); ?>

                  <?php echo form_close(); ?>
            </div>
      </div>