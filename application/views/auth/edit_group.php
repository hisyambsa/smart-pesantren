<div class="container">
      <div class="text-center row justify-content-center">
            <div class="col-md-6">
                  <h1><?php echo lang('edit_group_heading'); ?></h1>
                  <p><?php echo lang('edit_group_subheading'); ?></p>

                  <?php echo form_open(current_url()); ?>

                  <div class="md-form">
                        <?php echo lang('edit_group_name_label', 'group_name'); ?>
                        <?php echo form_input($group_name, '', 'class="form-control" required autofocus'); ?>
                  </div>

                  <div class="md-form">
                        <?php echo lang('edit_group_desc_label', 'description'); ?>
                        <?php echo form_input($group_description, '', 'class="form-control" required'); ?>
                  </div>

                  <div class="md-form"><?php echo form_submit('submit', lang('edit_group_submit_btn')); ?></div>

                  <?php echo form_close(); ?>
            </div>
      </div>