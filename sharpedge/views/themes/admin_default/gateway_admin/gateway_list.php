<script type="text/javascript">
$('#tab2').live('click', function()
{
	$('#tabs-2').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/gateway_admin/add_gateway",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-2').html(msg);
		}
	})
});
</script>
	<ul class="nav nav-tabs remove_underline" id="tabs">
		<li class="active"><a href="#tabs-1" data-toggle="tab"><?php echo $this->lang->line('label_manage_gateways');?></a></li>
		<li><a id="tab2" href="#tabs-2" data-toggle="tab"><?php echo $this->lang->line('label_new_gateway');?></a></li>
	</ul>
  
	<div class="tab-content">		
		<div class="tab-pane active" id="tabs-1">
			<table class="table table-striped text-size">
			<thead>
			<tr>
			<th>ID</th>
			<th><?php echo $this->lang->line('label_name');?></th>
			<th><?php echo $this->lang->line('label_module_name');?></th>
			<th><?php echo $this->lang->line('label_active');?></th>
			<th><?php echo $this->lang->line('label_controls');?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($query->result() as $row): ?>
			<tr>
			<td><?php echo $row->gateway_id?></td>
			<td><?php echo $row->name?></td>
			<td><?php echo $row->module_name?></td>
			<td><?php echo $row->active?></td>
			<td>
			<a class="btn" href="<?php echo site_url();?>/gateway_admin/edit_gateway/<?php echo $row->gateway_id?>"><i class="icon-pencil"></i> <?php echo $this->lang->line('label_edit');?></a>
			<a class="btn btn-danger" href="<?php echo site_url();?>/gateway_admin/delete_gateway/<?php echo $row->gateway_id?>" onClick="return confirm('Are you sure you want to Delete this item?')"><i class="icon-trash icon-white"></i> <?php echo $this->lang->line('label_delete');?></a>
			</td>
			</tr>
			<?php endforeach;?>
			</tbody>
			</table>
		</div>
		
		<div class="tab-pane" id="tabs-2">
		<?//php echo modules::run('gateway_admin/add_gateway');?>
		</div>
	</div>