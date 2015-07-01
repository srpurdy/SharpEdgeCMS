				<table class="table table-striped text-size">
					<tr>
						<th><?php echo $this->lang->line('label_first_name');?></th>
						<th><?php echo $this->lang->line('label_last_name');?></th>
						<th><?php echo $this->lang->line('label_email_address');?></th>
						<th><?php echo $this->lang->line('label_group');?></th>
						<th><?php echo $this->lang->line('label_status');?></th>
						<th><?php echo $this->lang->line('label_edit');?></th>
					</tr>
					<?php foreach ($user_by_name->result() as $user):?>
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
							<a class="btn btn-info" href="<?php echo base_url();?>user_admin/single_user_email/<?php echo $user->id?>"><span class="glyphicon glyphicon-envelope"></span> <?php echo $this->lang->line('label_email');?></a>
							</ul></td>
						</tr>
					<?php endforeach;?>
				</table>