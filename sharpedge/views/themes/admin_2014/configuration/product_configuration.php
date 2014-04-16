<?php $stats = $this->config->load('product_config');?>
<?php $allow_cart = $stats . $this->config->item('product_allow_cart');?>
<?php $details_button = $stats . $this->config->item('product_details_button');?>
<?php $require_login = $stats . $this->config->item('product_require_login');?>
<?php $product_char_limit = $stats . $this->config->item('product_char_limit');?>
<?php $product_normal_maxwidth = $stats . $this->config->item('product_normal_maxwidth');?>
<?php $product_normal_maxheight = $stats . $this->config->item('product_normal_maxheight');?>
<?php $product_normal_quality = $stats . $this->config->item('product_normal_quality');?>
<?php $product_thumbnail_maxwidth = $stats . $this->config->item('product_thumbnail_maxwidth');?>
<?php $product_thumbnail_maxheight = $stats . $this->config->item('product_thumbnail_maxheight');?>
<?php $product_thumbnail_quality = $stats . $this->config->item('product_thumbnail_quality');?>
<?php $product_category_maxwidth = $stats . $this->config->item('product_category_maxwidth');?>
<?php $product_category_maxheight = $stats . $this->config->item('product_category_maxheight');?>
<?php $product_category_quality = $stats . $this->config->item('product_category_quality');?>
<div class="form-horizontal">
<?php echo form_open('configuration/product_config/');?>
		<fieldset>
			<legend><?php echo $this->lang->line('product_config');?></legend>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('product_allow_cart');?></span>
				<select name="allow_cart" class="form-control">
				<option value="true"<?php if($allow_cart == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($allow_cart == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('product_details_button');?></span>
				<select name="details_button" class="form-control">
				<option value="true"<?php if($details_button == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($details_button == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('product_require_login');?></span>
				<select name="product_require_login" class="form-control">
				<option value="true"<?php if($require_login == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($require_login == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('product_max_chars');?></span>
				<input type="text" class="form-control" name="char_limit" value="<?php echo $product_char_limit;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('product_normal_maxwidth');?></span>
				<input type="text" class="form-control" name="normal_maxwidth" value="<?php echo $product_normal_maxwidth;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('product_normal_maxheight');?></span>
				<input type="text" class="form-control" name="normal_maxheight" value="<?php echo $product_normal_maxheight;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('product_normal_quality');?></span>
				<input type="text" class="form-control" name="normal_quality" value="<?php echo $product_normal_quality;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('product_category_maxwidth');?></span>
				<input type="text" class="form-control" name="category_maxwidth" value="<?php echo $product_category_maxwidth;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('product_category_maxheight');?></span>
				<input type="text" class="form-control" name="category_maxheight" value="<?php echo $product_category_maxheight;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('product_category_quality');?></span>
				<input type="text" class="form-control" name="category_quality" value="<?php echo $product_category_quality;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('product_thumbnail_maxwidth');?></span>
				<input type="text" class="form-control" name="thumbnail_maxwidth" value="<?php echo $product_thumbnail_maxwidth;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('product_thumbnail_maxheight');?></span>
				<input type="text" class="form-control" name="thumbnail_maxheight" value="<?php echo $product_thumbnail_maxheight;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('product_thumbnail_quality');?></span>
				<input type="text" class="form-control" name="thumbnail_quality" value="<?php echo $product_thumbnail_quality;?>" />
			</div>

			<input class="btn btn-primary" type="submit" value="Submit" />

</fieldset>
<?php echo form_close();?>
</div>