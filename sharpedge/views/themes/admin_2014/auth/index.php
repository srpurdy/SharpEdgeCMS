	<ul class="nav nav-tabs remove_underline" id="tabs">
		<li><a href="#tabs-1" data-toggle="tab"><?php echo $this->lang->line('manage_users');?></a></li>
		<li><a href="#tabs-2" data-toggle="tab"><?php echo $this->lang->line('add_users');?></a></li>
		<li><a href="#tabs-3" data-toggle="tab"><?php echo $this->lang->line('label_manage_groups');?></a></li>
		<li><a href="#tabs-4" data-toggle="tab"><?php echo $this->lang->line('label_add_group');?></a></li>
		<li><a href="#tabs-5" data-toggle="tab"><?php echo $this->lang->line('label_add_user_to_group');?></a></li>
		<li><a href="#tabs-6" data-toggle="tab"><?php echo $this->lang->line('label_mass_email');?></a></li>
	</ul>
	
	<div class="tab-content">		
		<div class="tab-pane active" id="tabs-1">
			<div class='mainInfo'>
				<div id="infoMessage"><?php echo $message;?></div>
				
				<table class="table table-striped text-size">
					<tr>
						<th><?php echo $this->lang->line('label_first_name');?></th>
						<th><?php echo $this->lang->line('label_last_name');?></th>
						<th><?php echo $this->lang->line('label_email_address');?></th>
						<th><?php echo $this->lang->line('label_group');?></th>
						<th><?php echo $this->lang->line('label_status');?></th>
						<th><?php echo $this->lang->line('label_edit');?></th>
					</tr>
					<?php foreach ($users as $user):?>
						<tr>
							<td><?php echo $user->first_name;?></td>
							<td><?php echo $user->last_name;?></td>
							<td><?php echo $user->email;?></td>
							<td>
								<?php foreach ($groups->result() as $group):?>
								<?php if($group->user_id == $user->id):?>
									<?php echo $group->name;?><br />
								<?php endif;?>
								<?php endforeach?>
							</td>
							<td><?php echo ($user->active) ? anchor($this->config->item('language_abbr') . "/user_admin/deactivate/".$user->id, 'Active') : anchor($this->config->item('language_abbr') . "/user_admin/activate/". $user->id . '/' . $user->activation_code, 'Inactive');?></td>
							<td>
							<a class="btn btn-default" href="<?php echo base_url();?>user_admin/edit_user/<?php echo $user->id?>"><span class="glyphicon glyphicon-pencil"></span> <?php echo $this->lang->line('label_edit');?></a>
							<a class="btn btn-danger" href="<?php echo base_url();?>user_admin/ban_user/<?php echo $user->id?>"><span class="glyphicon glyphicon-user"></span> <?php echo $this->lang->line('label_ban_user');?></a>
							<a class="btn btn-success" href="<?php echo base_url();?>user_admin/unban_user/<?php echo $user->id?>"><span class="glyphicon glyphicon-user"></span> <?php echo $this->lang->line('label_unban_user');?></a>
							</ul></td>
						</tr>
					<?php endforeach;?>
				</table>
			</div>
		</div>
		
		<div class="tab-pane" id="tabs-2">
		<?php echo modules::run('user_admin/create_user');?>
		</div>
		
		<div class="tab-pane" id="tabs-3">
		<?php echo modules::run('user_admin/manage_groups');?>
		</div>
		
		<div class="tab-pane" id="tabs-4">
		<?php echo modules::run('user_admin/add_group');?>
		</div>
		
		<div class="tab-pane" id="tabs-5">
		<?php echo modules::run('user_admin/add_to_group');?>
		</div>
		
		<div class="tab-pane" id="tabs-6">
		<?php echo modules::run('user_admin/mass_email');?>
		</div>
	</div>