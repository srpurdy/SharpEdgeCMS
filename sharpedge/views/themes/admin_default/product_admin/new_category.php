<div class="form-horizontal">
<?php echo form_open_multipart('product_admin/new_category');?>
		<fieldset>
			<legend><?php echo $this->lang->line('label_new_category');?></legend>
			
			<?php echo form_error('category_name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="category_name" value="" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_add_image');?></label>
				<div class="controls">
				<select name="add_image">
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
				<input type="text" class="field" name="parent_id" value="" />
				</div>
			</div>
			
			<?php echo form_error('desc'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_description');?></label>
				<div class="controls">
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: '';
				echo form_ckeditor('desc', $textareaContent);?>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_language');?></label>
				<div class="controls">
				<select name="lang">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>"><?php echo $la->lang?></option>
				<?php endforeach; ?>
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