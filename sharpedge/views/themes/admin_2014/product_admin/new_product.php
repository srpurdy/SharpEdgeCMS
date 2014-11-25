<?php if($tags->result()):?>
<div class="form-horizontal">
<?php echo form_open_multipart('product_admin/new_product');?>
		<fieldset>
			<legend><?php echo $this->lang->line('label_new_product');?></legend>
			
			<?php echo form_error('product_name'); ?>
			<?php $set_product_name = set_value('product_name');?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_product_name');?></span>
				<input type="text" class="form-control" name="product_name" value="<?php echo $set_product_name;?>" />
			</div>
			
			
			<?php echo form_error('brand_name'); ?>
			<?php $set_brand_name = set_value('brand_name');?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_brand_name');?></span>
				<input type="text" class="form-control" name="brand_name" value="<?php echo $set_brand_name;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sku');?></span>
				<input type="text" class="form-control" name="SKU" value="" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_weight');?></span>
				<input type="text" class="form-control" name="Weight" value="" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_weightunits');?></span>
				<select name="WeightUnits" class="form-control">
				<option value="Pounds"<?php echo set_select('WeightUnits', 'Pounds');?>><?php echo $this->lang->line('label_pounds');?></option>
				<option value="Ounces"<?php echo set_select('WeightUnits', 'Ounces');?>><?php echo $this->lang->line('label_ounces');?></option>
				<option value="Grams"<?php echo set_select('WeightUnits', 'Grams');?>><?php echo $this->lang->line('label_grams');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_add_image');?></span>
				<select name="add_image" class="form-control">
				<option value="Y"<?php echo set_select('add_image', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php echo set_select('add_image', 'N', TRUE);?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<?php $set_userfile = set_value('userfile');?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_image');?></span>
				<input type="file" class="form-control" name="userfile" value="<?php echo $set_userfile;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_gallery_cat');?></span>
				<select name="gallery_id" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('blog_select_gallery');?></option>
				<?php foreach($galleries->result() as $gal):?>
				<option value="<?php echo $gal->id?>" <?php echo set_select('gallery_id', $gal->id);?>><?php echo $gal->name?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<?php echo form_error('price'); ?>
			<?php $set_price = set_value('price');?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_price');?></span>
				<input type="text" class="form-control" name="price" value="<?php echo $set_price;?>" />
			</div>

			<?php echo form_error('desc'); ?>
			<?php $set_desc = set_value('desc');?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_description');?></span>
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: $set_desc;
				echo form_ckeditor('desc', $textareaContent);?>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_categories');?></span>
				<select class="form-control" name="tags[]" size=10 multiple>
				<?php foreach($tags->result() as $catname) : ?>
				<?php if($catname->parent_id == '0'):?>
				<option value="<?php echo $catname->id?>"><?php echo $catname->category_name?></option>
				<?php endif;?>
					<?php if($catname->has_child == 'Y'):?>
						<?php foreach($tags->result() as $sub):?>
							<?php if($sub->parent_id == $catname->id):?>
							<option value="<?php echo $sub->id?>" <?php echo set_select('tags', $sub->id);?>>&#160;&#160;&#160;-> <?php echo $sub->category_name?></option>
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
				<option value="<?php echo $dname->download_id?>"><?php echo $dname->download_name?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<?php $set_lang = set_value('lang');?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_language');?></span>
				<select name="lang" class="form-control">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php if($set_lang == $la->lang_short):?>selected="selected"<?php endif;?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<?php $set_sort = set_value('sort_id');?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sort');?></span>
				<input type="text" class="form-control" name="sort_id" value="<?php echo $set_sort?>" />
			</div>
			
			<?php echo form_error('stock'); ?>
			<?php $set_stock = set_value('stock');?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_stock');?></span>
				<input type="text" class="form-control" name="stock" value="<?php echo $set_stock;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_has_download');?></span>
				<select name="download" class="form-control">
				<option value="Y"<?php echo set_select('download', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php echo set_select('download', 'N');?>selected="selected"><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
	
			<?php $set_hide = set_value('hide');?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_hide');?></span>
				<select name="hide" class="form-control">
				<option value="Y"<?php if($set_hide == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($set_hide == 'N' OR $set_hide == ''):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
            
            <input class="btn btn-primary" type="submit" value="Submit" />
			
		</fieldset>
<?php echo form_close();?>
</div>
<?php else:?>
<p>You must create a category first.</p>
<?php endif;?>