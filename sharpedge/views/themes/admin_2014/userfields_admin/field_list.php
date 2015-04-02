<script type="text/javascript">
$(document).on('click', '#tab2', function()
{
	$('#tabs-2').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/userfields_admin/new_field",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-2').html(msg);
		}
	})
});
</script>
	<ul class="nav nav-tabs remove_underline" id="tabs">
		<li class="active"><a href="#tabs-1" data-toggle="tab"><?php echo $this->lang->line('manage_fields');?></a></li>
		<li><a id="tab2" href="#tabs-2" data-toggle="tab"><?php echo $this->lang->line('add_field');?></a></li>
	</ul>
	
	<div class="tab-content">		
		<div class="tab-pane active" id="tabs-1">
			<table class="table table-striped text-size">
				<thead>
					<tr>
						<th><?php echo $this->lang->line('label_name');?></th>
						<th><?php echo $this->lang->line('label_lang');?></th>
						<th><?php echo $this->lang->line('label_type');?></th>
						<th><?php echo $this->lang->line('label_sort');?></th>
						<th><?php echo $this->lang->line('label_controls');?></th>
					</tr>
				</thead>
				
				<tbody>
<?php foreach($query->result() as $id):?>
					<tr>
						<td><?php echo $id->name?></td>
						<td><?php echo $id->lang?></td>
						<td><?php echo $id->type?></td>
						<td><?php echo $id->sort_id?></td>
						<td>
						<a class="btn btn-default" href="<?php echo site_url();?>/userfields_admin/edit_field/<?php echo $id->id?>"><span class="glyphicon glyphicon-pencil"></span> <?php echo $this->lang->line('label_edit');?></a>
						<a class="btn btn-danger" href="<?php echo site_url();?>/userfields_admin/delete_field/<?php echo $id->id?>" onClick="return confirm('Are you sure you want to Delete this item? You cannot restore it once it is deleted......')"><span class="glyphicon glyphicon-trash"></span> <?php echo $this->lang->line('label_delete');?></a>
						</td>
					</tr>
<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		
		<div class="tab-pane" id="tabs-2">
		</div>
	</div>