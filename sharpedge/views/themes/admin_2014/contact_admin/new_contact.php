<div class="form-horizontal">
<?php echo form_open('contact_admin/new_contact');?>
		<fieldset>
			<legend><?php echo $this->lang->line('label_new_contact');?></legend>
			
			<?php echo form_error('contact_name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="contact_name" value="<?php echo set_value('contact_name');?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_email_address');?></span>
				<input type="text" class="form-control" name="email" value="<?php echo set_value('email');?>" />
			</div>
            
			<input class="btn btn-primary" type="submit" value="Submit" />

		</fieldset>
<?php echo form_close();?>
</div>