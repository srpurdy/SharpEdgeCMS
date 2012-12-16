<h3><?php echo $heading?></h3>
<ul class="thumbnails">
	<?php foreach($products->result() as $img): ?>
	<li class="span2b">
	<div class="thumbnail">
		<a href="<?php echo base_url();?>assets/products/normal/<?php echo $img->userfile?>" rel="lytebox"><img src="<?php echo base_url();?>assets/products/thumbs/<?php echo $img->userfile?>" alt="" width="145" height="83" /></a><br />
		<div style="display:block; width:100%; height: 90px; min-height: 230px; overflow:hidden;">
		<h5><?php echo $img->product_name;?></h5>
		<h4><?php if($img->price == '0.00'):?><?php else:?><?php echo $img->price;?><?php endif;?></h4>
		<h6>Brand: <?php echo $img->brand_name;?></h6>
		<h6><?php if($img->stock == -1):?>Many In Stock<?php elseif($img->stock == 0):?><?php echo $img->stock;?> Out Of Stock<?php else:?><?php echo $img->stock;?> In Stock<?php endif;?></h6><br />
		<?php $product_desc = truncateHtml($img->desc, $this->config->item('product_char_limit'));?>
		<p><?php echo $product_desc;?></p><br />
		<?php if($this->config->item('product_allow_cart') == true):?>
			<?php echo form_open('products/add_to_cart_view');?>
			<fieldset>
			<input type="hidden" name="product" value="<?php echo $img->product_id?>"/>
			<input type="submit" class="btn btn-primary" id="add_item_<?php echo $img->product_id?>" value="Add To Cart"/>
			</fieldset>
			<?php echo form_close();?>
		<?php endif;?>
		<?php if($this->config->item('product_details_button') == true):?>
		<a class="btn remove_underline" href="<?php echo site_url();?>/products/details/<?php echo $img->product_id?>">Details</a>
		<?php endif;?>
		</div>
	</div>
	</li>
	<?php endforeach;?>
</ul>