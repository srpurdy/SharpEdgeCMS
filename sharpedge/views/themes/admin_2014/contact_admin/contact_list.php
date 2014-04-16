<table class="table table-striped text-size">
	<thead>
		<tr>
			<th><?php echo $this->lang->line('label_name');?></th>
			<th><?php echo $this->lang->line('label_email_address');?></th>
			<th><?php echo $this->lang->line('label_controls');?></th>
		</tr>
	</thead>
	
	<tbody>
<?php foreach($query->result() as $id):?>
		<tr>
			<td><?php echo $id->contact_name?></td>
			<td><?php echo $id->email?></td>
			<td>
			<a class="btn btn-default" href="<?php echo site_url();?>/contact_admin/edit_contact/<?php echo $id->id?>"><span class="glyphicon glyphicon-pencil"></span> <?php echo $this->lang->line('label_edit');?></a>
			<a class="btn btn-danger" href="<?php echo site_url();?>/contact_admin/delete_contact/<?php echo $id->id?>" onClick="return confirm('Are you sure you want to Delete this item? You cannot restore it once it is deleted......')"><span class="glyphicon glyphicon-trash"></span>  <?php echo $this->lang->line('label_delete');?></a>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
	
</table>