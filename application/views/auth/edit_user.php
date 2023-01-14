<style>
      .col {
            flex-basis: auto;
      }
</style>
<div class="container">
      <div class="text-center row justify-content-center">
            <div class="col-md-6">
                  <h1><?php echo lang('edit_user_heading'); ?></h1>
                  <p><?php echo lang('edit_user_subheading'); ?></p>
                  <?php $attributes = array('autocomplete' => 'off'); ?>
                  <?php echo form_open(uri_string(), $attributes); ?>

                  <!-- <form action="<?= uri_string(); ?>"> -->
                  <div class="md-form">
                        <?php echo form_input($first_name, '', 'class="form-control" required autofocus'); ?>
                        <?php echo lang('edit_user_fname_label', 'first_name'); ?>
                  </div>

                  <div class="md-form">
                        <?php echo form_input($last_name, '', 'class="form-control" required'); ?>
                        <?php echo lang('edit_user_lname_label', 'last_name'); ?>
                  </div>

                  <div class="md-form">
                        <?php echo form_input($company, '', 'class="form-control" required'); ?>
                        <?php echo lang('edit_user_company_label', 'company'); ?>
                  </div>
                  <div class="md-form">
                        <?php echo form_input($email, '', 'class="form-control" required'); ?>
                        <?php echo lang('edit_user_email_label', 'email'); ?>
                  </div>

                  <div class="md-form">
                        <?php echo form_input($telp, '', 'class="form-control"  required'); ?>
                        <?php echo lang('edit_user_telp_label', 'telp'); ?>
                  </div>

                  <div class="md-form">
                        <?php echo form_input($job_level, '', 'class="form-control"  required'); ?>
                        <?php echo lang('edit_user_job_level_label', 'job_level'); ?>
                  </div>
                  <div class="md-form">
                        <?php echo form_input($unit_kerja, '', 'class="form-control" required'); ?>
                        <?php echo lang('edit_user_unit_kerja_label', 'unit_kerja'); ?>
                  </div>
                  <div class="md-form">
                        <?php echo form_input($password, '', 'class="form-control"'); ?>
                        <?php echo lang('edit_user_password_label', 'password'); ?>
                  </div>

                  <div class="md-form">
                        <?php echo form_input($password_confirm, '', 'class="form-control" '); ?>
                        <?php echo lang('edit_user_password_confirm_label', 'password_confirm'); ?><br />
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
                                                foreach ($currentGroups as $grp) {
                                                      if ($gID == $grp->id) {
                                                            $checked = ' checked="checked"';
                                                            break;
                                                      }
                                                }
                                                ?>
                                                <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>" <?php echo $checked ?> class="custom-control-input" id="<?php echo 'inputGrup' . $group['id']; ?>">
                                                <label class="custom-control-label" for="<?php echo 'inputGrup' . $group['id']; ?>"><?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?></label>
                                          </div>
                                    </div>
                                    &nbsp &nbsp
                              <?php endforeach ?>
                        </div>
                  <?php endif ?>

                  <?php echo form_hidden(['id' => $user->id]); ?>
                  <?php echo form_hidden($csrf); ?>

                  <p><?php echo form_submit('submit', lang('edit_user_submit_btn')); ?></p>

                  <?php echo form_close(); ?>
            </div>
      </div>