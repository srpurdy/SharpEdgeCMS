<div class="form-horizontal">
<?php echo form_open("user_admin/group_module_permissions/".$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_group_permissions');?></legend>
	
			<?php foreach($modules->result() as $md):?>
			
			<input type="hidden" name="group_id[]" value="<?php echo $this->uri->segment(3)?>" />
			<input type="hidden" name="module_id[]" value="<?php echo $md->id;?>" />

			<div class="control-group">
			<label class="control-label"><?php echo $md->name?> <?php echo $this->lang->line('label_read');?></label>
				<div class="controls">
				<select name="read[]">
				<option value="Y"<?php if($md->read_access == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" <?php if($md->read_access == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $md->name?> <?php echo $this->lang->line('label_write');?></label>
				<div class="controls">
				<select name="write[]">
				<option value="Y"<?php if($md->write_access  == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($md->write_access  == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
				

			<div class="control-group">
			<label class="control-label"><?php echo $md->name?> <?php echo $this->lang->line('label_delete');?></label>
				<div class="controls">
				<select name="delete[]">
				<option value="Y"<?php if($md->delete_access == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($md->delete_access == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>

			<?php endforeach;?>

            <div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
</div>