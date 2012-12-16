<script type="text/javascript">
$('#tab2').live('click', function()
{
	$('#tabs-2').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/menu_admin/addmenu",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-2').html(msg);
		}
	})
});
</script>
	<ul class="nav nav-tabs remove_underline" id="tabs">
		<li class="active"><a href="#tabs-1" data-toggle="tab"><?php echo $this->lang->line('manage_nav');?></a></li>
		<li><a id="tab2" href="#tabs-2" data-toggle="tab"><?php echo $this->lang->line('new_nav_item');?></a></li>
	</ul>
	
	<div class="tab-content">		
		<div class="tab-pane active" id="tabs-1">
			<table class="table table-striped text-size">
			<thead>
			<tr>
			<th>ID</th>
			<th><?php echo $this->lang->line('label_name');?></th>
			<th><?php echo $this->lang->line('label_parent');?></th>
			<th><?php echo $this->lang->line('label_sort');?></th>
			<th><?php echo $this->lang->line('label_hidden');?></th>
			<th><?php echo $this->lang->line('label_lang');?></th>
			<th><?php echo $this->lang->line('label_controls');?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($query->result() as $row): ?>
			<tr>
			<td><?php echo $row->id?></td>
			<td><?php echo $row->text?></td>
			<td><?php echo $row->parent_id?></td>
			<td><?php echo $row->orderfield?></td>
			<td><?php echo $row->hide?></td>
			<td><?php echo $row->lang?></td>
			<td>
			<a class="btn" href="<?php echo site_url();?>/menu_admin/editmenu/<?php echo $row->id?>"><i class="icon-pencil"></i> <?php echo $this->lang->line('label_edit');?></a>
			<a class="btn btn-danger" href="<?php echo site_url();?>/menu_admin/deletemenu/<?php echo $row->id?>" onClick="return confirm('Are you sure you want to Delete this item?')"><i class="icon-trash icon-white"></i> <?php echo $this->lang->line('label_delete');?></a>
			</td>
			</tr>
			<?php endforeach;?>
			</tbody>
			</table>
		</div>
		
		<div class="tab-pane" id="tabs-2">
		<?//php echo modules::run('menu_admin/addmenu');?>
		</div>
	</div>