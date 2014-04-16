<div class="form-horizontal">
<?php echo smiley_js(); ?>
<?php echo form_open('widget_admin/addwidget/');?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_widget');?></legend>
			
			<?php echo form_error('name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="name" value="<?php echo set_value('name');?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_system_name');?></span>
				<input type="text" class="form-control" name="system_name" value="<?php echo set_value('system_name');?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_mode');?></span>
				<select name="mode" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_mode');?></option>
				<option value="F" <?php echo set_select('mode', 'F');?>><?php echo $this->lang->line('label_file_based');?></option>
				<option value="B" <?php echo set_select('mode', 'B');?>><?php echo $this->lang->line('label_html_based');?></option>
				</select>
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_html_based');?></span>
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: set_value('bbcode');
				echo form_ckeditor('bbcode', $textareaContent);?>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_language');?></span>
				<select name="lang" class="form-control">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php echo set_select('lang', $la->lang_short);?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			
	</fieldset>
<?php echo form_close();?>
</div>