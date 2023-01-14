<div class="container">
      <div class="text-center row justify-content-center">
            <div class="col-md-6">
                  <h1><?php echo lang('forgot_password_heading'); ?></h1>
                  <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label); ?></p>

                  <?php echo form_open("auth/forgot_password", 'class="form-signin"'); ?>

                  <div class="md-form">
                        <label for="identity"><?php echo (($type == 'email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label)); ?></label> <br />
                        <?php echo form_input($identity, '', 'class="form-control" placeholder="Masukan Email" required autofocus'); ?>
                  </div>

                  <div class="md-form"><?php echo form_submit('submit', lang('forgot_password_submit_btn')); ?></div>

                  <?php echo form_close(); ?>
            </div>
      </div>