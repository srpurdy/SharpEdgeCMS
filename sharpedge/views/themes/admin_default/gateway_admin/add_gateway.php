<div class="form-horizontal">
<?php echo form_open('gateway_admin/add_gateway/');?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_new_gateway');?></legend>  
			
			<?php echo form_error('name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="name" value="<?php echo set_value('name');?>" />
				</div>
			</div>
			
			<?php echo form_error('module_name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_module_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="module_name" value="<?php echo set_value('module_name');?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_active');?></label>
				<div class="controls">
				<select name="active">
				<option value="N" <?php echo set_select('active', 'Y');?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php echo set_select('active', 'N', TRUE);?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
				</div>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
</div>