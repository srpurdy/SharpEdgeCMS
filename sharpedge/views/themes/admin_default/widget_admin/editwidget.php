<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo smiley_js(); ?>
<?php echo form_open('widget_admin/editwidget/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_widget');?></legend>
			
			<?php echo form_error('name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="name" value="<?php echo $id->name?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_system_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="system_name" value="<?php echo $id->system_name?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_mode');?></label>
				<div class="controls">
				<select name="mode">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_mode');?></option>
				<option value="F" <?php if($id->mode == 'F'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_file_based');?></option>
				<option value="B" <?php if($id->mode == 'B'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_html_based');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_html_based');?></label>
				<div class="controls">
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: $id->bbcode;
				echo form_ckeditor('bbcode', $textareaContent);?>
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
			
            <div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>