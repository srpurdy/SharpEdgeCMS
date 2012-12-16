<script type="text/javascript">
		$(document).ready(function()
		{
			var cart_data = {
				csrf_sharpedgeV320: $("#csrf_protection").val(),
				poll_id: $('#poll_id').val()
			};
			$('#cart_widget').html('<div style="text-align:center;"><img src="<?php echo base_url();?>/assets/images/system_images/loading/dots32.gif" alt="" /></div>');
			$.ajax(
			{
				url: "<?php echo site_url();?>/products/show_cart/",
				type: "GET",
				success: function(msg)
				{
					$('#cart_widget').html(msg);
				}
			})
		});
</script>
<div id="cart_widget">
</div>