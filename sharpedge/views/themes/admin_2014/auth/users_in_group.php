	<ul class="nav nav-tabs remove_underline" id="tabs">
		<li><a href="#tabs-1" data-toggle="tab"><?php echo $this->lang->line('label_users_in_group');?></a></li>
		<li><a href="#tabs-2" data-toggle="tab"><?php echo $this->lang->line('label_add_to_group');?></a></li>
	</ul>
	
	<div class="tab-content">		
		<div class="tab-pane active" id="tabs-1">
			<table class="table table-striped text-size">
				<tr>
					<th>ID</th>
					<th><?php echo $this->lang->line('label_username');?></th>
					<th><?php echo $this->lang->line('label_name');?></th>
					<th><?php echo $this->lang->line('label_controls');?></th>
				</tr>
				<?php foreach ($users_in_group->result() as $id):?>
					<tr>
						<td><?php echo $id->id;?></td>
						<td><?php echo $id->username;?></td>
						<td><?php echo $id->first_name . ' ' .$id->last_name;?></td>
						<td>
						<a class="btn btn-danger" href="<?php echo site_url()?>/user_admin/delete_user_in_group/<?php echo $this->uri->segment(3);?>/<?php echo $id->id?>" onClick="return confirm('Are you sure you want to Delete this item?')"><span class="glyphicon glyphicon-trash"></span> <?php echo $this->lang->line('label_delete');?></a>
						</td>
					</tr>
				<?php endforeach;?>
			</table>
		</div>
		
		<div class="tab-pane" id="tabs-2">
		<?php echo modules::run('user_admin/add_to_group');?>
		</div>
	</div>