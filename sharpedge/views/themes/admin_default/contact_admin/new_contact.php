<div class="form-horizontal">
<?php echo form_open('contact_admin/new_contact');?>
		<fieldset>
			<legend><?php echo $this->lang->line('label_new_contact');?></legend>
			
			<?php echo form_error('contact_name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="contact_name" value="<?php echo set_value('contact_name');?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_email_address');?></label>
				<div class="controls">
				<input type="text" class="field" name="email" value="<?php echo set_value('email');?>" />
				</div>
			</div>
            
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
		</fieldset>
<?php echo form_close();?>
</div>