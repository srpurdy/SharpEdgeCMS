<?php $stats = $this->config->load('contact_config');?>
<?php $contact_subject = $stats . $this->config->item('contact_subject');?>
<?php $multi_contact = $stats . $this->config->item('multi_contact');?>
<?php $security = $stats . $this->config->item('security_image');?>
<div class="form-horizontal">
<?php echo form_open('configuration/contact_config/');?>
		<fieldset>
			<legend><?php echo $this->lang->line('contact_config');?></legend>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('config_subject');?></label>
				<div class="controls">
				<input type="text" class="span7" name="contact_subject" value="<?php echo $contact_subject;?>" />
				</div>
			</div>
            
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('config_allow_multi_contact');?></label>
				<div class="controls">
				<select name="multi_contact">
				<option value="true"<?php if($multi_contact == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($multi_contact == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_security_image');?></label>
				<div class="controls">
				<select name="security_image">
				<option value="true"<?php if($security == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($security == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
				</div>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
</fieldset>
<?php echo form_close();?>
</div>