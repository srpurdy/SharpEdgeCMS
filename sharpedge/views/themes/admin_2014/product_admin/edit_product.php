<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo form_open_multipart('product_admin/edit_product/'.$this->uri->segment(3));?>
	<input type="hidden" id="id" name="product_id" value="<?php echo $id->product_id?>">
		<fieldset>
			<legend><?php echo $this->lang->line('label_edit_product');?></legend>
			
			<?php echo form_error('product_name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_product_name');?></span>
				<input type="text" class="form-control" name="product_name" value="<?php echo $id->product_name?>" />
			</div>
			
			<?php echo form_error('brand_name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_brand_name');?></span>
				<input type="text" class="form-control" name="brand_name" value="<?php echo $id->brand_name?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sku');?></span>
				<input type="text" class="form-control" name="SKU" value="<?php echo $id->SKU?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_weight');?></span>
				<input type="text" class="form-control" name="Weight" value="<?php echo $id->Weight?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_weightunits');?></span>
				<select name="WeightUnits" class="form-control">
				<option value="Pounds" <?php if($id->WeightUnits == 'Pounds'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_pounds');?></option>
				<option value="Ounces" <?php if($id->WeightUnits == 'Ounces'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_ounces');?></option>
				<option value="Grams" <?php if($id->WeightUnits == 'Grams'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_grams');?></option>
				<option value="Kilograms" <?php if($id->WeightUnits == 'Kilograms'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_kgrams');?></option>
				</select>
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_filename');?></span>
				<input type="text" class="form-control" name="current_file" value="<?php echo $id->userfile?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_update_image');?></span>
				<select name="update_image" class="form-control">
				<option value="Y"><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" selected="selected"><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_image');?></span>
				<input type="file" class="form-control" name="userfile" value="" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_gallery_cat');?></span>
				<select name="gallery_id" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('blog_select_gallery');?></option>
				<?php foreach($galleries->result() as $gal):?>
				<option value="<?php echo $gal->id?>" <?php if($gal->id == $id->gallery_id):?>selected="selected"<?php endif;?>><?php echo $gal->name?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<?php echo form_error('price'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_price');?></span>
				<input type="text" class="form-control" name="price" value="<?php echo $id->price?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon">Currency</span>
				<select name="currency" class="form-control">
				<option value="USD"<?php if($id->currency == 'USD'):?>selected="selected"<?php endif;?>>USD</option>
				<option value="CAD"<?php if($id->currency == 'CAD'):?>selected="selected"<?php endif;?>>CAD</option>
				<option value="GBP"<?php if($id->currency == 'GBP'):?>selected="selected"<?php endif;?>>GBP</option>
				</select>
			</div>

			<?php echo form_error('desc'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_description');?></span>
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: $id->desc;
				echo form_ckeditor('desc', $textareaContent);?>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_categories');?></span>
				<select class="form-control" name="tags[]" size=10 multiple>
				<?php foreach($tags->result() as $catname) : ?>
				<?php if($catname->parent_id == '0'):?>
				<option value="<?php echo $catname->id?>"
				<?php foreach($get_categories->result() as $gc):?>
				<?php if($catname->id == $gc->cat_id):?>
				selected="selected"
				<?php endif;?>
				<?php endforeach;?>><?php echo $catname->category_name?></option>
				<?php endif;?>
					<?php if($catname->has_child == 'Y'):?>
						<?php foreach($tags->result() as $sub):?>
							<?php if($sub->parent_id == $catname->id):?>
							<option value="<?php echo $sub->id?>"
							<?php foreach($get_categories->result() as $gc):?>
				<?php if($sub->id == $gc->cat_id):?>
				selected="selected"
				<?php endif;?>
				<?php endforeach;?>> &#160;&#160;&#160;-> <?php echo $sub->category_name?></option>
							<?php endif;?>
						<?php endforeach;?>
					<?php endif;?>
				<?php endforeach; ?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_downloads');?></span>
				<select class="form-control" name="downloads[]" size=10 multiple>
				<?php foreach($downloads->result() as $dname) : ?>
				<option value="<?php echo $dname->download_id;?>" 
				<?php foreach($get_downloads->result() as $gd):?>
				<?php if($dname->download_id == $gd->download_id):?>
				selected="selected"
				<?php endif;?>
				<?php endforeach;?>><?php echo $dname->download_name?></option>
				<?php endforeach;?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_language');?></span>
				<select name="lang" class="form-control">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php if($id->lang == $la->lang_short):?>selected="selected"<?php endif;?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sort');?></span>
				<input type="text" class="form-control" name="sort_id" value="<?php echo $id->sort_id?>" />
			</div>
			
			<?php echo form_error('stock'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_stock');?></span>
				<input type="text" class="form-control" name="stock" value="<?php echo $id->stock?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_has_download');?></span>
				<select name="download" class="form-control">
				<option value="N"<?php if($id->download == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y"<?php if($id->download == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_hide');?></span>
				<select name="hide" class="form-control">
				<option value="N"<?php if($id->hide == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y"<?php if($id->hide == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
			</div>
            
            <input class="btn btn-primary" type="submit" value="Submit" />
			
		</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>