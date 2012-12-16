<div class="form-horizontal">
<?php foreach($query->result() as $id ) : ?>
<?php echo form_open('gateway_admin/edit_gateway/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('edit_lang');?></legend>
		
			<input type="hidden" id="id" name="gateway_id" value="<?php echo $this->uri->segment(3)?>">

			<?php echo form_error('name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="name" value="<?php echo $id->name?>" />
				</div>
			</div>
			
			<?php echo form_error('module_name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_module_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="module_name" value="<?php echo $id->module_name?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_active');?></label>
				<div class="controls">
				<select name="active">
				<option value="N" <?php if($id->active == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php if($id->active == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
				</div>
			</div>
            
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach; ?>
</div>