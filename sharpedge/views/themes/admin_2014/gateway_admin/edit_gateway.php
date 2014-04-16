<div class="form-horizontal">
<?php foreach($query->result() as $id ) : ?>
<?php echo form_open('gateway_admin/edit_gateway/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_gateway');?></legend>
		
			<input type="hidden" id="id" name="gateway_id" value="<?php echo $this->uri->segment(3)?>">

			<?php echo form_error('name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="name" value="<?php echo $id->name?>" />
			</div>
			
			<?php echo form_error('module_name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_module_name');?></span>
				<input type="text" class="form-control" name="module_name" value="<?php echo $id->module_name?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_active');?></span>
				<select name="active" class="form-control">
				<option value="N" <?php if($id->active == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php if($id->active == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
			</div>
            
			<input class="btn btn-primary" type="submit" value="Submit" />
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach; ?>
</div>