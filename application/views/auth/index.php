<div class="container">
	<div class="text-center row justify-content-center">
		<div class="col-md-12">
			<h1><?php echo lang('index_heading'); ?></h1>
			<p><?php echo lang('index_subheading'); ?></p>
			<p><?php echo anchor('auth/create_user', lang('index_create_user_link')) ?> | <?php echo anchor('auth/create_group', lang('index_create_group_link')) ?></p>
			<div class="table-responsive">

				<table class="table table-hover dataTableRun">
					<thead>
						<tr>
							<th><?php echo lang('index_fname_th'); ?></th>
							<th><?php echo lang('index_lname_th'); ?></th>
							<th><?php echo lang('index_email_th'); ?></th>
							<th><?php echo lang('index_groups_th'); ?></th>
							<th><?php echo lang('index_status_th'); ?></th>
							<th><?php echo lang('index_action_th'); ?></th>
						</tr>
					</thead>
					<?php foreach ($users as $user) : ?>
						<tr>
							<td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
							<td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
							<td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
							<td>
								<?php foreach ($user->groups as $group) : ?>
									<?php echo anchor("auth/edit_group/" . $group->id, htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8')); ?><br />
								<?php endforeach ?>
							</td>
							<td><?php echo ($user->active) ? anchor("auth/deactivate/" . $user->id, lang('index_active_link')) : anchor("auth/activate/" . $user->id, lang('index_inactive_link')); ?></td>
							<td><?php echo anchor("auth/edit_user/" . $user->id, 'Edit'); ?></td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
	<script defer>
		$(document).ready(function() {
			var table = $('.dataTableRun').DataTable({
				dom: 'lBfrtip', //default (B button -> Blfrtip)
				paging: true,
				pageLength: 10,
				"pagingType": "full_numbers",
				"lengthMenu": [ // show all
					[10, 25, 50, -1],
					[10, 25, 50, "All"]
				],
				buttons: [{
					extend: 'colvis',
				}],
				responsive: true,
				"columnDefs": [{
					"width": "10px",
					"targets": [0, 1, 2],
					className: 'noVis'
				}]

			});
			$('.dataTables_length').addClass('bs-select');
			$('.dataTables_wrapper').find('label').each(function() {
				$(this).parent().append($(this).children());
			});
			$('.dataTables_wrapper .dataTables_filter').find('input').each(function() {
				const $this = $(this);
				$this.attr("placeholder", "Cari disini...");
				$this.removeClass('form-control-sm');
			});

			$('.dataTables_wrapper .dataTables_filter').addClass('md-form');

			$('.dataTables_wrapper .dataTables_filter').find('label').remove();

			$('.md-form').css('margin-top', '0px');
			$('.md-form').css('margin-bottom', '0px');
		});
	</script>