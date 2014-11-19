<script type="text/javascript">
$(document).on('click', '#tab2', function()
{
	$('#tabs-2').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/blog_admin/new_blog_post",
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
		url: "<?php echo site_url();?>/blog_admin/manage_categories",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-3').html(msg);
		}
	})
});

$(document).on('click', '#tab4', function()
{
	$('#tabs-4').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/blog_admin/new_category",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-4').html(msg);
		}
	})
});

$(document).on('click', '#tab5', function()
{
	$('#tabs-5').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/blog_admin/manage_comments",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-5').html(msg);
		}
	})
});

$(document).on('click', '#tab6', function()
{
	$('#tabs-6').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/blog_admin/update_thumbnails_display",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-6').html(msg);
		}
	})
});

$(document).on('click', '#blog_page_limit', function()
{
	$('#tabs-1').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/blog_admin/update_thumbnails_display",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-6').html(msg);
		}
	})
});
</script>
<input type="hidden" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf_protection" />
	<ul class="nav nav-tabs remove_underline" id="tabs">
		<li class="active"><a href="#tabs-1" data-toggle="tab"><?php echo $this->lang->line('manage_blog');?></a></li>
		<li><a id="tab2" href="#tabs-2" data-toggle="tab"><?php echo $this->lang->line('new_blog_post');?></a></li>
		<li><a id="tab3" href="#tabs-3" data-toggle="tab"><?php echo $this->lang->line('blog_cats');?></a></li>
		<li><a id="tab4" href="#tabs-4" data-toggle="tab"><?php echo $this->lang->line('blog_add_cat');?></a></li>
		<li><a id="tab5" href="#tabs-5" data-toggle="tab"><?php echo $this->lang->line('manage_blog_comments');?></a></li>
		<li><a id="tab6" href="#tabs-6" data-toggle="tab"><?php echo $this->lang->line('label_update_images');?></a></li>
	</ul>

	<div class="tab-content">		
		<div class="tab-pane active" id="tabs-1">
		<div class="pagination"><?php echo $this->pagination->create_links();?></div>
		<div class="clearfix"></div>
		
			<table class="table table-striped text-size">
				<thead>
					<tr>
					<th>ID</th>
						<th><?php echo $this->lang->line('label_title');?></th>
						<th><?php echo $this->lang->line('label_date');?></th>
						<th><?php echo $this->lang->line('blog_author');?></th>
						<th><?php echo $this->lang->line('label_active');?></th>
						<th><?php echo $this->lang->line('label_views');?></th>
						<th><?php echo $this->lang->line('label_lang');?></th>
						<th><?php echo $this->lang->line('label_controls');?></th>
					</tr>
				</thead>
				
				<tbody>
<?php foreach($query->result() as $id):?>
					<tr>
						<td><?php echo $id->blog_id?></td>
						<td><?php echo $id->name?></td>
						<td><?php echo $id->date?></td>
						<td><?php echo $id->postedby?></td>
						<td><?php echo $id->active?></td>
						<td><?php echo $id->views?></td>
						<td><?php echo $id->lang?></td>
						<td>
						<a class="btn btn-default" href="<?php echo site_url();?>/blog_admin/edit_blog_post/<?php echo $id->blog_id?>"><span class="glyphicon glyphicon-pencil"></span> <?php echo $this->lang->line('label_edit');?></a>
						<a class="btn btn-danger" href="<?php echo site_url();?>/blog_admin/delete_blog_post/<?php echo $id->blog_id?>" onClick="return confirm('Are you sure you want to Delete this item? You cannot restore it once it is deleted......')"><span class="glyphicon glyphicon-trash"></span> <?php echo $this->lang->line('label_delete');?></a>
						</td>
					</tr>
<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		
		<div class="tab-pane" id="tabs-2">
		</div>
		
		<div class="tab-pane" id="tabs-3">
		</div>
		
		<div class="tab-pane" id="tabs-4">
		</div>
		
		<div class="tab-pane" id="tabs-5">
		</div>
		
		<div class="tab-pane" id="tabs-6">
		</div>	
	</div>