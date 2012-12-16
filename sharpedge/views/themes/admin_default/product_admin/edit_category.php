<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo form_open_multipart('product_admin/edit_category/'.$this->uri->segment(3));?>
	<input type="hidden" id="id" name="id" value="<?php echo $id->id?>">
		<fieldset>
			<legend><?php echo $this->lang->line('label_edit_category');?></legend>
			
			<?php echo form_error('category_name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="category_name" value="<?php echo $id->category_name?>" />
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
			<label class="control-label"><?php echo $this->lang->line('label_parent');?></label>
				<div class="controls">
				<input type="text" class="field" name="parent_id" value="<?php echo $id->parent_id?>" />
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
				<input type="text" class="field" name="sort_id" value="<?php echo $id->sort_id;?>" />
				</div>
			</div>
            
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
			
		</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>