<div class="container">
      <div class="text-center row justify-content-center">
            <div class="col-md-6">
                  <h1><?= lang('create_user_heading'); ?></h1>
                  <p><?= lang('create_user_subheading'); ?></p>
                  <div class="text-danger">
                        <?= (validation_errors()); ?>
                  </div>
                  <?= form_open("auth/create_user", array(
                        'autocomplete' => strtotime('now'),
                        'id' => 'form_id',
                        'method' => 'post'
                  )); ?>

                  <div class="md-form">
                        <?= form_input($first_name, '', 'class="form-control" required'); ?>
                        <?= lang('create_user_fname_label', 'first_name'); ?>
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
                        <?= form_input($password, '', 'class="form-control" required'); ?>
                        <?= lang('create_user_password_label', 'password'); ?>
                  </div>

                  <div class="md-form">
                        <?= form_input($password_confirm, '', 'class="form-control" required',); ?>
                        <?= lang('create_user_password_confirm_label', 'password_confirm'); ?>
                  </div>
                  <h3><?= lang('edit_user_groups_heading'); ?></h3>
                  <div class="row">
                        <?php foreach ($groups as $group) : ?>
                              <?php if ($group['name'] != 'admin' and $group['name'] != 'all_users') : ?>
                                    <div class="col">
                                          <div class="custom-control custom-checkbox">
                                                <?php
                                                $gID = $group['id'];
                                                $checked = null;
                                                $item = null;
                                                ?>
                                                <input type="checkbox" name="groups[]" value="<?= $group['id']; ?>" <?= $checked ?> class="custom-control-input" id="<?= 'inputGrup' . $group['id']; ?>">
                                                <label class="custom-control-label" for="<?= 'inputGrup' . $group['id']; ?>"><?= htmlspecialchars($group['description'], ENT_QUOTES, 'UTF-8'); ?></label>
                                          </div>
                                    </div>
                                    &nbsp &nbsp
                              <?php endif; ?>
                        <?php endforeach ?>
                  </div>
                  <br><br>
                  <p><?= form_submit('submit', lang('create_user_submit_btn'), array(
                              'autocomplete' => strtotime('now'),
                              'id' => 'button_id',
                              'class' => 'btn btn-success'
                        )); ?></p>

                  <?= form_close(); ?>
            </div>
      </div>