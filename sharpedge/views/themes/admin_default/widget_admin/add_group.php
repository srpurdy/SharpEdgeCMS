<div class="form-horizontal">
<?php echo form_open('widget_admin/new_widget_group');?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_group');?></legend>
			
			<?php echo form_error('name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" value="<?php echo set_value('name'); ?>" name="name" />
				</div>
			</div>
			
            <div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
</div>