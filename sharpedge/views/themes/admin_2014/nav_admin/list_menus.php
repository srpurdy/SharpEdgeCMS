<select name="menu_id" id="menu_id" class="form-control">
<?php foreach($menus->result() as $m):?>
	<option value="<?php echo $m->menu_id;?>"><?php echo $m->name;?></option>
<?php endforeach;?>
</select>
<script type="text/javascript">
$(document).ready(function()
{
	$('#menu_number').val($('#menu_id').val());
	$('#menu_number2').val($('#menu_id').val());
	var menu_data = {
				csrf_sharpedgeV320: $("#csrf_protection").val(),
				menu_id: $('#menu_id').val()
			};

	$.ajax(
	{
		url: "<?php echo site_url();?>/nav_admin/manage_menu_items",
		type: "POST",
		data: menu_data,
		success: function(msg)
		{
			$('#load_menu_items').html(msg);
		}
	})
	
	$(document).on('change', '#menu_id', function()
	{
	$('#menu_number').val($('#menu_id').val());
	$('#menu_number2').val($('#menu_id').val());
	var menu_data = {
				csrf_sharpedgeV320: $("#csrf_protection").val(),
				menu_id: $('#menu_id').val()
			};

	$.ajax(
	{
		url: "<?php echo site_url();?>/nav_admin/manage_menu_items",
		type: "POST",
		data: menu_data,
		success: function(msg)
		{
			$('#load_menu_items').html(msg);
		}
	})
	
	});
});
</script>
<div id="load_menu_items"></div>