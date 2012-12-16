<?php if($tags->result()):?>
<div class="form-horizontal">
<?php echo form_open_multipart('product_admin/new_product');?>
		<fieldset>
			<legend><?php echo $this->lang->line('label_new_product');?></legend>
			
			<?php echo form_error('product_name'); ?>
			<?php $set_product_name = set_value('product_name');?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_product_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="product_name" value="<?php echo $set_product_name;?>" />
				</div>
			</div>
			
			
			<?php echo form_error('brand_name'); ?>
			<?php $set_brand_name = set_value('brand_name');?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_brand_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="brand_name" value="<?php echo $set_brand_name;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_add_image');?></label>
				<div class="controls">
				<select name="add_image">
				<option value="Y"<?php echo set_select('add_image', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php echo set_select('add_image', 'N', TRUE);?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<?php $set_userfile = set_value('userfile');?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_image');?></label>
				<div class="controls">
				<input type="file" class="field" name="userfile" value="<?php echo $set_userfile;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_gallery_cat');?></label>
				<div class="controls">
				<select name="gallery_id">
				<option value="0" selected="selected"><?php echo $this->lang->line('blog_select_gallery');?></option>
				<?php foreach($galleries->result() as $gal):?>
				<option value="<?php echo $gal->id?>" <?php echo set_select('gallery_id', $gal->id);?>><?php echo $gal->name?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<?php echo form_error('price'); ?>
			<?php $set_price = set_value('price');?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_price');?></label>
				<div class="controls">
				<input type="text" class="field" name="price" value="<?php echo $set_price;?>" /><?php echo $this->lang->line('label_price_info');?>
				</div>
			</div>

			<?php echo form_error('desc'); ?>
			<?php $set_desc = set_value('desc');?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_description');?></label>
				<div class="controls">
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: $set_desc;
				echo form_ckeditor('desc', $textareaContent);?>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_categories');?></label>
				<div class="controls">
				<select class="field" name="tags[]" style="width:250px;" size=10 multiple>
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
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_downloads');?></label>
				<div class="controls">
				<select class="field" name="downloads[]" style="width:250px;" size=10 multiple>
				<?php foreach($downloads->result() as $dname) : ?>
				<option value="<?php echo $dname->download_id?>"><?php echo $dname->download_name?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<?php $set_lang = set_value('lang');?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_language');?></label>
				<div class="controls">
				<select name="lang">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php if($set_lang == $la->lang_short):?>selected="selected"<?php endif;?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<?php $set_sort = set_value('sort_id');?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_sort');?></label>
				<div class="controls">
				<input type="text" class="field" name="sort_id" value="<?php echo $set_sort?>" />
				</div>
			</div>
			
			<?php echo form_error('stock'); ?>
			<?php $set_stock = set_value('stock');?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_stock');?></label>
				<div class="controls">
				<input type="text" class="field" name="stock" value="<?php echo $set_stock;?>" /><?php echo $this->lang->line('label_stock_info');?>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_has_download');?></label>
				<div class="controls">
				<select name="download">
				<option value="Y"<?php echo set_select('download', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php echo set_select('download', 'N');?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
	
			<?php $set_hide = set_value('hide');?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_hide');?></label>
				<div class="controls">
				<select name="hide">
				<option value="Y"<?php if($set_hide == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($set_hide == 'N' OR $set_hide == ''):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_sort');?></label>
				<div class="controls">
				<input type="text" class="field" name="sort_id" value="" />
				</div>
			</div>
            
            <div class="form-actions">
            <input class="btn btn-primary" type="submit" value="Submit" />
			</div>
			
		</fieldset>
<?php echo form_close();?>
</div>
<?php else:?>
<p>You must create a category first.</p>
<?php endif;?>