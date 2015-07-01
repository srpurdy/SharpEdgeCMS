<script type="text/javascript">
$(document).on('click', '#tab2', function()
{
	$('#tabs-2').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/page_admin/addpage",
		type: "GET",
		success: function(msg)
		{
			if (CKEDITOR.instances['text']) {
				delete CKEDITOR.instances['text'];
			}
			$('#tabs-2').html(msg);
		}
	})
});

$(document).on('click', '#tab3', function()
{
	$('#tabs-3').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/page_admin/manage_page_drafts",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-3').html(msg);
		}
	})
});

$(document).on('click', '#page_search', function()
{
	$('#tabs-1').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	var search_data = {
		csrf_sharpedgeV320: $("#csrf_protection").val(),
		ps: $("#ps").val()
	};
	$.ajax(
	{
		url: "<?php echo site_url();?>/page_admin/search_pages",
		type: "POST",
		data: search_data,
		success: function(msg)
		{
			$('#tabs-1').html(msg);
		}
	})
	return false;
});
</script>
<input type="hidden" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf_protection" />
<div class="search_pages">
<div class="form-horizontal">
<form class="form-search">
    <div class="input-append pull-right">
	<div class="input-group">
		<span class="input-group-addon">Search</span>
        <input type="text" id="ps" class="form-control search-query" value="">
		<span class="input-group-btn">
        <button type="submit" id="page_search" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
		</div>
	</div>
	</div>
</form>
</div>
</div>
	<ul class="nav nav-tabs remove_underline" id="tabs">
		<li class="active"><a id="tab1" href="#tabs-1" data-toggle="tab"><?php echo $this->lang->line('manage_pages');?></a></li>
		<li><a id="tab2" href="#tabs-2" data-toggle="tab"><?php echo $this->lang->line('label_add_page');?></a></li>
		<li><a id="tab3" href="#tabs-3" data-toggle="tab"><?php echo $this->lang->line('manage_page_drafts');?></a></li>
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active" id="tabs-1">
			<div class="pagination"><?php echo $this->pagination->create_links();?></div>
			<div class="clearfix"></div>
			
			<table class="table table-striped text-size">
			<thead>
			<tr>
			<th>ID</th>
			<th><?php echo $this->lang->line('label_name');?></th>
			<th><?php echo $this->lang->line('label_url_title');?></th>
			<th><?php echo $this->lang->line('label_views');?></th>
			<th><?php echo $this->lang->line('label_lang');?></th>
			<th><?php echo $this->lang->line('label_last_modified');?></th>
			<th><?php echo $this->lang->line('label_controls');?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($query->result() as $row): ?>
			<tr>
			<td><?php echo $row->id?></td>
			<td><?php echo $row->name?><?php foreach($has_draft->result() as $hd):?><?php if($row->url_name == $hd->url_name AND $row->lang == $hd->lang):?><span class="label label-danger"><?php echo $this->lang->line('label_has_draft');?></span><?php endif;?><?php endforeach;?></td>
			<td><?php echo $row->url_name?></td>
			<td><?php echo $row->views?></td>
			<td><?php echo $row->lang?></td>
			<td><?php echo $row->last_modified?></td>
			<td>
			<a class="btn btn-default" href="<?php echo site_url();?>/page_admin/editpage/<?php echo $row->id?>"><span class="glyphicon glyphicon-pencil"></span> <?php echo $this->lang->line('label_edit');?></a>
			<a class="btn btn-warning" href="<?php echo site_url();?>/page_admin/reset_page_views/<?php echo $row->id?>"><span class="glyphicon glyphicon-off"></span> <?php echo $this->lang->line('label_reset');?></a>
			<a class="btn btn-danger" href="<?php echo site_url();?>/page_admin/deletepage/<?php echo $row->id?>" onClick="return confirm('Are you sure you want to Delete this item?')"><span class="glyphicon glyphicon-trash"></span> <?php echo $this->lang->line('label_delete');?></a>
			</td>
			</tr>
			<?php endforeach;?>
			</tbody>
			</table>
		</div>
		
		<div class="tab-pane" id="tabs-2">
		</div>
		
		<div class="tab-pane" id="tabs-3">
		</div>
	</div>