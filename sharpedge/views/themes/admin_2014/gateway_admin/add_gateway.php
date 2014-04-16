<div class="form-horizontal">
<?php echo form_open('gateway_admin/add_gateway/');?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_new_gateway');?></legend>  
			
			<?php echo form_error('name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="name" value="<?php echo set_value('name');?>" />
			</div>
			
			<?php echo form_error('module_name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_module_name');?></span>
				<input type="text" class="form-control" name="module_name" value="<?php echo set_value('module_name');?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_active');?></span>
				<select name="active" class="form-control">
				<option value="N" <?php echo set_select('active', 'Y');?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php echo set_select('active', 'N', TRUE);?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
			</div>
			
			<input class="btn btn-primary" type="submit" value="Submit" />
			
	</fieldset>
<?php echo form_close();?>
</div>