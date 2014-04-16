<?php $now =  date('Y-m');?>
<script type="text/javascript">
$(document).ready(function(){
	$('#chart').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	var gstat = $('#gstat').val();
	$.ajax(
	{
		url: "<?php echo site_url();?>/dashboard/stat_by_month_year/<?php echo $now;?>-01",
		type: "GET",
		success: function(msg)
		{
			$('#chart').html(msg);
			google.setOnLoadCallback(drawChart);
		}
	})
});
$(document).on('change', '#gstat', function()
{
	$('#chart').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	var gstat = $('#gstat').val();
	$.ajax(
	{
		url: "<?php echo site_url();?>/dashboard/stat_by_month_year/"+ gstat + '-01',
		type: "GET",
		success: function(msg)
		{
			$('#chart').html(msg);
			google.setOnLoadCallback(drawChart);
		}
	})
});
</script>
<div style="width:100%;margin-left:0px;">
	<div style="float:right;top:15px;position:relative;">
	<select name="gstats" class="form-control" id="gstat">
	<?php foreach($result as $r):?>
		<?php $current = strtotime($r);?>
		<?php if(date('d', $current) == '01'):?>
		<option value="<?php echo date('Y-m', $current);?>" <?php if($now == date('Y-m', $current)):?>selected="selected"<?php endif;?>><?php echo date('F Y', $current);?></option>
		<?php endif;?>
	<?php endforeach;?>
	</select>
	</div>
	<div style="clear:both;"></div>
<div id="chart" style="width: 100%; min-height:500px;"></div>
</div>