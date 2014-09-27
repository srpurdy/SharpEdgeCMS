<script type="text/javascript">
$(document).on('click', '#tab2', function()
{
	$('#tabs-2').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/product_admin/new_shipping/<?php echo $this->uri->segment(3);?>",
		type: "GET",
		success: function(msg)
		{
			if (CKEDITOR.instances['desc']) {
				delete CKEDITOR.instances['desc'];
			}
			$('#tabs-2').html(msg);
		}
	})
});
</script>	
	
	<ul class="nav nav-tabs remove_underline" id="tabs">
		<li class="active"><a href="#tabs-1" data-toggle="tab"><?php echo $this->lang->line('label_manage_shipping');?></a></li>
		<li><a id="tab2" href="#tabs-2" data-toggle="tab"><?php echo $this->lang->line('label_new_shipping');?></a></li>
	</ul>
	
	<div class="tab-content">		
		<div class="tab-pane active" id="tabs-1">
			<table class="table table-striped text-size">
				<thead>
					<tr>
						<th><?php echo $this->lang->line('label_name');?></th>
						<th><?php echo $this->lang->line('label_price');?></th>
						<th><?php echo $this->lang->line('label_controls');?></th>
					</tr>
				</thead>				
				<tbody>
				<?php foreach($query->result() as $id):?>
					<tr>
						<td><?php echo $id->name?></td>
						<td><?php echo $id->price?></td>
						<td>
						<a class="btn btn-default" href="<?php echo site_url();?>/product_admin/edit_shipping/<?php echo $id->product_id;?>/<?php echo $id->id?>"><span class="glyphicon glyphicon-pencil"></span> <?php echo $this->lang->line('label_edit');?></a>
						<a class="btn btn-danger" href="<?php echo site_url();?>/product_admin/delete_shipping/<?php echo $id->id?>" onClick="return confirm('Are you sure you want to Delete this item? You cannot restore it once it is deleted......')"><span class="glyphicon glyphicon-trash"></span> <?php echo $this->lang->line('label_delete');?></a>
						</td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		</div>
		
		<div class="tab-pane" id="tabs-2">
		</div>
		
	</div>