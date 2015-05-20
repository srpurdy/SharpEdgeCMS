<h3><?php echo $heading?></h3>
	<?php foreach($products->result() as $img): ?>
	<div class="col-xs-3 col-md-4">
		<?php if($this->config->item('product_details_button') == true):?>
		<a href="<?php echo site_url();?>/products/details/<?php echo $img->product_id?>"><h5><?php echo $img->product_name;?></h5></a>
		<?php else:?>
		<h5><?php echo $img->product_name;?></h5>
		<?php endif;?>
		<a href="<?php echo base_url();?>assets/products/normal/<?php echo $img->userfile?>" rel="lytebox"><img src="<?php echo base_url();?>assets/products/thumbs/<?php echo $img->userfile?>" alt="" /></a>
		<div class="alert alert-success"><?php if($img->currency == 'CAD' OR $img->currency == 'USD'):?>$<?php endif;?><?php if($img->currency == 'GBP'):?>&pound;<?php endif;?><?php if($img->price == '0.00'):?><?php else:?><?php echo $img->price;?><?php endif;?></div>
		<p>
		<?php if($img->stock == -1):?>
		<?php echo $this->lang->line('label_many_stock');?>
		<?php elseif($img->stock == 0):?>
		<?php echo $img->stock;?> <?php echo $this->lang->line('label_out_of_stock');?>
		<?php else:?>
		<?php echo $img->stock;?> <?php echo $this->lang->line('label_in_stock');?>
		<?php endif;?>
		<?php $this->db->order_by('shipping_by_product.price', 'asc');?>
		<?php $this->db->where('shipping_by_product.product_id', $img->product_id);?>
		<?php $shipping = $this->db->get('shipping_by_product');?>
		<?php if($shipping->result()):?>
			<select class="form-control" name="shipping_price_<?php echo $img->product_id?>" id="shipping_price_<?php echo $img->product_id?>">
			<?php foreach($shipping->result() as $s):?>
			<option value="<?php echo $s->price;?>"><?php echo $s->name;?> - $<?php echo $s->price;?></option>
			<?php endforeach;?>
			</select>
		<?php endif;?>
		</p>
		<?php if($this->config->item('product_allow_cart') == true):?>
			<?php $cart = array('style' => 'margin:0px');?>
			<?php echo form_open('products/add_to_cart_view', $cart);?>
			<input type="hidden" name="product" value="<?php echo $img->product_id?>"/>
			<button class="btn btn-primary pull-left product_to_cart" data-product="<?php echo $img->product_id?>"><span class="glyphicon glyphicon-shopping-cart"></span></button>
			<?php echo form_close();?>
		<?php endif;?>
	</div>
	<?php endforeach;?>