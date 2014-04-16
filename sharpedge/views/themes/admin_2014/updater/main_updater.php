<style type="text/css">
.updater_process_window{border:1px solid #ddd;height:400px;overflow:auto;}
</style>
<script type="text/javascript">
$(document).on('click', '#update_now', function()
{
	$('#update_now').hide();
	$('#updater_ajax').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$('#update_version').html('<img src="/assets/images/system_images/loading/bar90.gif" alt="" />');
	$.ajax(
	{
		url: "<?php echo site_url();?>/updater/download_core_update",
		type: "GET",
		success: function(msg)
		{
			$('#updater_ajax').html(msg);
			$('#update_now').show();
			$.ajax(
			{
				url: "<?php echo site_url();?>/updater/check_version_ajax",
				type: "GET",
				success: function(msg)
				{
					$('#update_version').html(msg);
				}
			})
		}
	})
	return false;
});
</script>
<h4><?php echo $this->lang->line('label_current_version');?> : <span id="update_version"><?php echo $version?></span></h4>
<h4><?php echo $this->lang->line('label_latest_version');?> : <?php echo $latest_version?></h4>
<div class="clearfix"></div>
<hr />
<p><?php echo $this->lang->line('label_update_para');?>
<div class="clearfix"></div>
<a id="update_now" class="btn btn-success" href="#"><?php echo $this->lang->line('label_update_now');?></a>
</p>
<div class="clearfix"></div>
<hr />
<p><?php echo $this->lang->line('label_update_summary');?></p>
<div class="updater_process_window form-control" id="updater_ajax">
</div>