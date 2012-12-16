<h3><?php echo $heading?></h3>
<ul class="thumbnails">
	<?php foreach($product->result() as $img): ?>
	<li class="span4b">
	<div class="thumbnail">
		<a href="<?php echo base_url();?>assets/products/normal/<?php echo $img->userfile?>" rel="lytebox"><img src="<?php echo base_url();?>assets/products/normal/<?php echo $img->userfile?>" alt="" width="315" height="180" /></a><br />
		<div style="display:block; width:100%; min-height: 230px;">
		<h5><?php echo $img->product_name;?></h5>
		<h4><?php if($img->price == '0.00'):?><?php else:?><?php echo $img->price;?><?php endif;?></h4>
		<h6>Brand: <?php echo $img->brand_name;?></h6>
		<h6><?php if($img->stock == -1):?>Many In Stock<?php elseif($img->stock == 0):?><?php echo $img->stock;?> Out Of Stock<?php else:?><?php echo $img->stock;?> In Stock<?php endif;?></h6><br />
		<?php $product_desc = $img->desc;?>
		<p><?php echo $product_desc;?></p><br />
		<?php if($this->config->item('product_allow_cart') == true):?>
			<?php echo form_open('products/add_to_cart_view');?>
			<fieldset>
			<input type="hidden" name="product" value="<?php echo $img->product_id?>"/>
			<input type="submit" class="btn btn-primary" id="add_item_<?php echo $img->product_id?>" value="Add To Cart"/>
			</fieldset>
			<?php echo form_close();?>
		<?php endif;?>
		</div>
	</div>
	</li>
	<?php endforeach;?>
</ul>
<div id="post_gallery">
</div>
<script type="text/javascript">
$(document).ready( function () {
   	var site_data = {
		csrf_sharpedgeV320: $("#csrf_protection").val()
	};
	$.ajax(
	{
		url: "/products/ajax_gallery/"+<?=$img->gallery_id;?>,
		type: "POST",
		data: site_data,
		success: function(msg)
		{
			//alert(msg);
			$('#post_gallery').html(msg);
			initLytebox();
		}
	})
});
</script>