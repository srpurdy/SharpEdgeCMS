<h3><?php echo $heading?></h3>
<ul class="thumbnails">
	<?php foreach($products->result() as $img): ?>
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
	<li>
	<div class="thumbnail span3">
		<a href="<?php echo base_url();?>assets/products/normal/<?php echo $img->userfile?>" rel="lytebox"><img src="<?php echo base_url();?>assets/products/thumbs/<?php echo $img->userfile?>" alt="" width="300" height="171" /></a><br />
		<div style="display:block; width:100%; height: 90px; min-height: 230px; overflow:hidden;">
		<h5><?php echo $img->product_name;?></h5>
		<span class="label label-important">$<?php if($img->price == '0.00'):?><?php else:?><?php echo $img->price;?><?php endif;?></span>
		<small><?php if($img->stock == -1):?>Many In Stock<?php elseif($img->stock == 0):?><?php echo $img->stock;?> Out Of Stock<?php else:?><?php echo $img->stock;?> In Stock<?php endif;?></small>
		<?php $product_desc = truncateHtml($img->desc, $this->config->item('product_char_limit'));?>
		<p><?php echo $product_desc;?></p>
		<?php if($this->config->item('product_allow_cart') == true):?>
			<?php $cart = array('style' => 'margin:0px');?>
			<?php echo form_open('products/add_to_cart_view', $cart);?>
			<input type="hidden" name="product" value="<?php echo $img->product_id?>"/>
			<input type="submit" class="btn btn-primary pull-left" id="add_item_<?php echo $img->product_id?>" value="Add To Cart"/>
			<?php echo form_close();?>
		<?php endif;?>
		<?php if($this->config->item('product_details_button') == true):?>
		<a class="btn btn-small remove_underline pull-right" href="<?php echo site_url();?>/products/details/<?php echo $img->product_id?>">Details</a>
		<?php endif;?>
		</div>
	</div>
	</li>
	<?php endforeach;?>
</ul>