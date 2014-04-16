<h3><?php echo $heading?></h3>
	<?php foreach($product->result() as $img): ?>
	<script type="text/javascript">
		$('#add_item_<?php echo $img->product_id?>').live('click', function()
		{
			var cart_data = {
				csrf_sharpedgeV320: $("#csrf_protection").val(),
				product: '<?php echo $img->product_id?>'
			};
			
			$('#cart_widget').html('<div style="text-align:center;"><img src="<?php echo base_url();?>/assets/images/system_images/loading/dots32.gif" alt="" /></div>');
			$.ajax(
			{
				url: "<?php echo site_url();?>/products/add_to_cart/",
				type: "POST",
				data: cart_data,
				success: function(msg)
				{
					$('#cart_widget').html(msg);
				}
			})
		return false;
		});
	</script>
	<div class="col-xs-3 col-md-5" style="padding:0px;">
		<a href="<?php echo base_url();?>assets/products/normal/<?php echo $img->userfile?>" rel="lytebox"><img src="<?php echo base_url();?>assets/products/normal/<?php echo $img->userfile?>" alt="" /></a>
	</div>
	<div class="col-xs-3 col-md-5">
	<h5><?php echo $img->product_name;?></h5>
	<div class="alert alert-success">$<?php if($img->price == '0.00'):?><?php else:?><?php echo $img->price;?><?php endif;?></div>
		<p>
		<?php if($img->stock == -1):?>
		<?php echo $this->lang->line('label_many_stock');?>
		<?php elseif($img->stock == 0):?>
		<?php echo $img->stock;?> <?php echo $this->lang->line('label_out_of_stock');?>
		<?php else:?>
		<?php echo $img->stock;?> <?php echo $this->lang->line('label_in_stock');?>
		<?php endif;?>
		</p>
		<?php $product_desc = $img->desc;?>
		<p><?php echo $product_desc;?></p>
		<?php if($this->config->item('product_allow_cart') == true):?>
			<?php echo form_open('products/add_to_cart_view');?>
			<fieldset>
			<input type="hidden" name="product" value="<?php echo $img->product_id?>"/>
			<input type="submit" class="btn btn-primary" id="add_item_<?php echo $img->product_id?>" value="<?php echo $this->lang->line('label_add_to_cart');?>" />
			</fieldset>
			<?php echo form_close();?>
		<?php endif;?>
	</div>
	<?php endforeach;?>
<div class="clearfix"></div><br />
<div id="post_gallery">
</div>
<script type="text/javascript">
$(document).ready( function () {
   	var site_data = {
		csrf_sharpedgeV320: $("#csrf_protection").val()
	};
	$.ajax(
	{
		url: "/products/ajax_gallery/<?php echo $img->gallery_id;?>",
		type: "GET",
		success: function(msg)
		{
			//alert(msg);
			$('#post_gallery').html(msg);
			initLytebox();
		}
	})
});
</script>