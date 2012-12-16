<script type="text/javascript">
$('#tab2').live('click', function()
{
	$('#tabs-2').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/template/addcontainer",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-2').html(msg);
		}
	})
});
</script>
	<ul class="nav nav-tabs remove_underline" id="tabs">
		<li class="active"><a href="#tabs-1" data-toggle="tab"><?php echo $this->lang->line('manage_cont');?></a></li>
		<li><a id="tab2" href="#tabs-2" data-toggle="tab"><?php echo $this->lang->line('new_cont');?></a></li>
	</ul>
	
	<div class="tab-content">		
		<div class="tab-pane active" id="tabs-1">
			<table class="table table-striped text-size">
			<thead>
			<tr>
			<th>ID</th>
			<th><?php echo $this->lang->line('label_name');?></th>
			<th><?php echo $this->lang->line('label_controls');?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($get_containers->result() as $row): ?>
			<tr>
			<td><?php echo $row->c_id?></td>
			<td><?php echo $row->container_name?></td>
			<td>
			<a class="btn" href="<?php echo site_url()?>/template/editcontainer/<?php echo $row->c_id?>"><i class="icon-pencil"></i> <?php echo $this->lang->line('label_edit');?></a>
			<a class="btn btn-danger" href="<?php echo site_url()?>/template/deletecontainer/<?php echo $row->c_id?>" onClick="return confirm('Are you sure you want to Delete this item?')"><i class="icon-trash icon-white"></i> <?php echo $this->lang->line('label_delete');?></a>
			</td>
			</tr>
			<?php endforeach;?>
			</tbody>
			</table>
		</div>
		
		<div class="tab-pane" id="tabs-2">
		</div>
	</div>