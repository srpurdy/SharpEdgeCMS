<style type="text/css">
.updater_process_window{border:1px solid #ddd;height:400px;overflow:auto;}
</style>
<script type="text/javascript">
$('#update_now').live('click', function()
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
<h4>Current Version : <span id="update_version"><?php echo $version?></span></h4>
<h4>Latest Version : <?php echo $latest_version?></h4>
<div class="clearfix"></div>
<hr />
<p>It is highly suggested you perform software updates. You can do so by pushing the Update Now button below. Some of these updates may take sometime to process be patient, As this can be an extensive proceedure. If you haven't updated on a regular basis you may need to do mutiple updates.
<div class="clearfix"></div>
<a id="update_now" class="btn btn-success" href="#">Update Now</a>
</p>
<div class="clearfix"></div>
<hr />
<p>Below is the summary of the update process.</p>
<div class="updater_process_window" id="updater_ajax">
</div>