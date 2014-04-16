<?php $stats = $this->config->load('analytics');?>
<?php $username = $stats . $this->config->item('username');?>
<?php $password = $stats . $this->config->item('password');?>
<?php $profile_id = $stats . $this->config->item('profile_id');?>
<?php $start_date = $stats . $this->config->item('start_date');?>
<p><?php echo $this->lang->line('config_google_paragraph');?></p>
<div class="form-horizontal">
<?php echo form_open('configuration/webstat_config/');?>
		<fieldset>
			<legend><?php echo $this->lang->line('stat_config');?></legend>
            
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_username');?></span>
				<input type="text" class="form-control" name="username" value="<?php echo $username;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_password');?></span>
				<input type="password" class="form-control" name="password" value="<?php echo $password;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_profile_id');?></span>
				<input type="text" class="form-control" name="profile_id" value="<?php echo $profile_id;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_start_date');?></span>
				<input type="text" class="form-control" name="start_date" value="<?php echo $start_date;?>" />
			</div>
			
			<input class="btn btn-primary" type="submit" value="Submit" />

</fieldset>
<?php echo form_close();?>
</div>