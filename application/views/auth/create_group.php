<div class="container">
      <div class="text-center row justify-content-center">
            <div class="col-md-6">
                  <h1><?php echo lang('create_group_heading'); ?></h1>
                  <p><?php echo lang('create_group_subheading'); ?></p>

                  <?php echo form_open("auth/create_group"); ?>

                  <div class="md-form">
                        <?php echo lang('create_group_name_label', 'group_name'); ?>
                        <?php echo form_input($group_name, '', 'class="form-control" required autofocus'); ?>
                  </div>

                  <div class="md-form">
                        <?php echo lang('create_group_desc_label', 'description'); ?>
                        <?php echo form_input($description, '', 'class="form-control" required'); ?>
                  </div>

                  <div class="md-form"><?php echo form_submit('submit', lang('create_group_submit_btn')); ?></div>

                  <?php echo form_close(); ?>
            </div>
      </div>