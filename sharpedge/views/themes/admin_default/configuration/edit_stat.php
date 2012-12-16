<?php $stats = $this->config->load('analytics');?>
<?php $username = $stats . $this->config->item('username');?>
<?php $password = $stats . $this->config->item('password');?>
<p><?php echo $this->lang->line('config_google_paragraph');?></p>
<div class="form-horizontal">
<?php echo form_open('configuration/webstat_config/');?>
		<fieldset>
			<legend><?php echo $this->lang->line('stat_config');?></legend>
            
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_username');?></label>
				<div class="controls">
				<input type="text" class="field" name="username" value="<?php echo $username;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_password');?></label>
				<div class="controls">
				<input type="password" class="field" name="password" value="<?php echo $password;?>" />
				</div>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
</fieldset>
<?php echo form_close();?>
</div>