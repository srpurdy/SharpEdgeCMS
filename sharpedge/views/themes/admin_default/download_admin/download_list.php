<script type="text/javascript">
$('#tab2').live('click', function()
{
	$('#tabs-2').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/download_admin/add_download",
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
		<li class="active"><a href="#tabs-1" data-toggle="tab"><?php echo $this->lang->line('label_manage_downloads');?></a></li>
		<li><a id="tab2" href="#tabs-2" data-toggle="tab"><?php echo $this->lang->line('label_new_download');?></a></li>
	</ul>
	
	<div class="tab-content">		
		<div class="tab-pane active" id="tabs-1">
			<table class="table table-striped text-size">
			<thead>
			<tr>
			<th>Id</th>
			<th><?php echo $this->lang->line('label_name');?></th>
			<th><?php echo $this->lang->line('label_sort');?></th>
			<th><?php echo $this->lang->line('label_filename');?></th>
			<th><?php echo $this->lang->line('label_is_product');?></th>
			<th><?php echo $this->lang->line('label_controls');?></th>
			</tr>
			</thead>
			<tbody>
			<?$chars = 150;?>
			<?php foreach($query->result() as $id):?>
			<tr>
			<td><?php echo $id->download_id?></td>
			<td><?php echo $id->download_name?></td>
			<td><?php echo $id->sort_id?></td>
			<td><?php echo $id->userfile?></td>
			<td><?php echo $id->isProduct?></td>
			<td>
			<a class="btn" href="<?php echo site_url();?>/download_admin/edit_download/<?php echo $id->download_id?>"><i class="icon-pencil"></i> <?php echo $this->lang->line('label_edit');?></a>
			<a class="btn btn-danger" href="<?php echo site_url();?>/download_admin/delete_download/<?php echo $id->download_id?>" onClick="return confirm('Are you sure you want to Delete this item? You cannot restore it once it is deleted......')"><i class="icon-trash icon-white"></i> <?php echo $this->lang->line('label_delete');?></a>
			</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
			</table>
		</div>
		
		<div class="tab-pane" id="tabs-2">
		<?//php echo modules::run('download_admin/add_download');?>
		</div>
	</div>