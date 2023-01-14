<div class="container">
      <div class="text-center row justify-content-center">
            <div class="col-md-6">
                  <h1><?php echo lang('create_user_heading'); ?></h1>
                  <p><?php echo lang('create_user_subheading'); ?></p>
                  <?php
                  var_dump(validation_errors());
                  ?>
                  <?php echo form_open("auth/create_user"); ?>

                  <div class="md-form">
                        <?php echo form_input($first_name, '', 'class="form-control" required'); ?>
                        <?php echo lang('create_user_fname_label', 'first_name'); ?>
                  </div>

                  <div class="md-form">
                        <?php echo form_input($last_name, '', 'class="form-control" required'); ?>
                        <?php echo lang('create_user_lname_label', 'last_name'); ?>
                  </div>

                  <?php
                  if ($identity_column !== 'email') {
                        echo '<div class="md-form">';
                        echo form_error('identity');
                        echo form_input($identity, '', 'class="form-control" required');
                        echo lang('create_user_identity_label', 'identity');
                        echo '</div>';
                  }
                  ?>
                  <div class="md-form">
                        <?php echo form_input($company, '', 'class="form-control" required'); ?>
                        <?php echo lang('create_user_company_label', 'company'); ?>
                  </div>

                  <div class="md-form">
                        <?php echo form_input($email, '', 'class="form-control" required'); ?>
                        <?php echo lang('create_user_email_label', 'email'); ?>
                  </div>

                  <div class="md-form">
                        <?php echo form_input($phone, '', 'class="form-control" required'); ?>
                        <?php echo lang('create_user_phone_label', 'phone'); ?>
                  </div>
                  <div class="md-form">
                        <?php echo form_input($job_level, '', 'class="form-control" required'); ?>
                        <?php echo lang('create_user_job_level_label', 'job_level'); ?>
                  </div>
                  <div class="md-form">
                        <?php echo form_input($unit_kerja, '', 'class="form-control" required'); ?>
                        <?php echo lang('create_user_unit_kerja_label', 'unit_kerja'); ?>
                  </div>
                  <div class="md-form">
                        <?php echo form_input($password, '', 'class="form-control" required'); ?>
                        <?php echo lang('create_user_password_label', 'password'); ?>
                  </div>

                  <div class="md-form">
                        <?php echo form_input($password_confirm, '', 'class="form-control" required'); ?>
                        <?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?>
                  </div>
                  <?php if ($this->ion_auth->is_admin()) : ?>

                        <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
                        <div class="row">
                              <?php foreach ($groups as $group) : ?>
                                    <div class="col">
                                          <div class="custom-control custom-checkbox">
                                                <?php
                                                $gID = $group['id'];
                                                $checked = null;
                                                $item = null;
                                                // foreach ($currentGroups as $grp) {
                                                //       if ($gID == $grp->id) {
                                                //             $checked = ' checked="checked"';
                                                //             break;
                                                //       }
                                                // }
                                                // 
                                                ?>
                                                <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>" <?php echo $checked ?> class="custom-control-input" id="<?php echo 'inputGrup' . $group['id']; ?>">
                                                <label class="custom-control-label" for="<?php echo 'inputGrup' . $group['id']; ?>"><?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?></label>
                                          </div>
                                    </div>
                                    &nbsp &nbsp
                              <?php endforeach ?>
                        </div>
                  <?php endif ?>

                  <p><?php echo form_submit('submit', lang('create_user_submit_btn')); ?></p>

                  <?php echo form_close(); ?>
            </div>
      </div>