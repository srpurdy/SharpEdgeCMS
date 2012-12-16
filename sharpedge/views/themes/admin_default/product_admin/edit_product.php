<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo form_open_multipart('product_admin/edit_product/'.$this->uri->segment(3));?>
	<input type="hidden" id="id" name="product_id" value="<?php echo $id->product_id?>">
		<fieldset>
			<legend><?php echo $this->lang->line('label_edit_product');?></legend>
			
			<?php echo form_error('product_name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_product_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="product_name" value="<?php echo $id->product_name?>" />
				</div>
			</div>
			
			<?php echo form_error('brand_name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_brand_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="brand_name" value="<?php echo $id->brand_name?>" />
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_filename');?></label>
				<div class="controls">
				<input type="text" class="field" name="current_file" value="<?php echo $id->userfile?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_update_image');?></label>
				<div class="controls">
				<select name="update_image">
				<option value="Y"><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" selected="selected"><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_image');?></label>
				<div class="controls">
				<input type="file" class="field" name="userfile" value="" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_gallery_cat');?></label>
				<div class="controls">
				<select name="gallery_id">
				<option value="0" selected="selected"><?php echo $this->lang->line('blog_select_gallery');?></option>
				<?php foreach($galleries->result() as $gal):?>
				<option value="<?php echo $gal->id?>" <?php if($gal->id == $id->gallery_id):?>selected="selected"<?php endif;?>><?php echo $gal->name?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<?php echo form_error('price'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_price');?></label>
				<div class="controls">
				<input type="text" class="field" name="price" value="<?php echo $id->price?>" /><?php echo $this->lang->line('label_price_info');?>
				</div>
			</div>

			<?php echo form_error('desc'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_description');?></label>
				<div class="controls">
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: $id->desc;
				echo form_ckeditor('desc', $textareaContent);?>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_categories');?></label>
				<div class="controls">
				<select class="field" name="tags[]" style="width:250px;" size=10 multiple>
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
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_downloads');?></label>
				<div class="controls">
				<select class="field" class="field" style="width:250px;" name="downloads[]" size=10 multiple>
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
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_language');?></label>
				<div class="controls">
				<select name="lang">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php if($id->lang == $la->lang_short):?>selected="selected"<?php endif;?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_sort');?></label>
				<div class="controls">
				<input type="text" class="field" name="sort_id" value="<?php echo $id->sort_id?>" />
				</div>
			</div>
			
			<?php echo form_error('stock'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_stock');?></label>
				<div class="controls">
				<input type="text" class="field" name="stock" value="<?php echo $id->stock?>" /><?php echo $this->lang->line('label_stock_info');?>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_has_download');?></label>
				<div class="controls">
				<select name="download">
				<option value="N"<?php if($id->download == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y"<?php if($id->download == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_hide');?></label>
				<div class="controls">
				<select name="hide">
				<option value="N"<?php if($id->hide == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y"<?php if($id->hide == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
				</div>
			</div>
            
            <div class="form-actions">
            <input class="btn btn-primary" type="submit" value="Submit" />
			</div>
			
		</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>