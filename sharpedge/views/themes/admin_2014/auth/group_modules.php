<div class="form-horizontal">
<?php echo form_open("user_admin/group_module_permissions/".$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_group_permissions');?></legend>
	
			<?php foreach($modules->result() as $md):?>
			
			<input type="hidden" name="group_id[]" value="<?php echo $this->uri->segment(3)?>" />
			<input type="hidden" name="module_id[]" value="<?php echo $md->id;?>" />

			<div class="input-group">
				<span class="input-group-addon"><?php echo $md->name?> <?php echo $this->lang->line('label_read');?></span>
				<select name="read[]" class="form-control">
				<option value="Y"<?php if($md->read_access == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" <?php if($md->read_access == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $md->name?> <?php echo $this->lang->line('label_write');?></span>
				<select name="write[]" class="form-control">
				<option value="Y"<?php if($md->write_access  == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($md->write_access  == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
				

			<div class="input-group">
				<span class="input-group-addon"><?php echo $md->name?> <?php echo $this->lang->line('label_delete');?></span>
				<select name="delete[]" class="form-control">
				<option value="Y"<?php if($md->delete_access == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($md->delete_access == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>

			<?php endforeach;?>

			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			
	</fieldset>
<?php echo form_close();?>
</div>