<?php $this->config->load('recaptcha');?>
<?php $this->_rConfig = $this->config->item('recaptcha');?>
<?php $recaptcha_public = $this->_rConfig['public'];?>
<?php $recaptcha_private = $this->config->item('private', 'recaptcha');?>
<?php $recaptcha_api_server = $this->config->item('RECAPTCHA_API_SERVER', 'recaptcha');?>
<?php $recaptcha_api_secure_server = $this->config->item('RECAPTCHA_API_SECURE_SERVER', 'recaptcha');?>
<?php $recaptcha_verify_server = $this->config->item('RECAPTCHA_VERIFY_SERVER', 'recaptcha');?>
<?php $recaptcha_signup_url = $this->config->item('RECAPTCHA_SIGNUP_URL', 'recaptcha');?>
<?php $recaptcha_theme = $this->config->item('re_theme', 'recaptcha');?>
<div class="form-horizontal">
<?php echo form_open('configuration/recaptcha_config/');?>
		<fieldset>
			<legend><?php echo $this->lang->line('recaptcha_config');?></legend>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('recaptcha_public_key');?></span>
				<input type="text" class="form-control" name="public_key" value="<?php echo $recaptcha_public;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('recaptcha_private_key');?></span>
				<input type="text" class="form-control" name="private_key" value="<?php echo $recaptcha_private;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('recaptcha_api_server');?></span>
				<input type="text" class="form-control" name="api_server" value="<?php echo $recaptcha_api_server;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('recaptcha_api_secure_server');?></span>
				<input type="text" class="form-control" name="api_secure_server" value="<?php echo $recaptcha_api_secure_server;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('recaptcha_verify_server');?></span>
				<input type="text" class="form-control" name="verify_server" value="<?php echo $recaptcha_verify_server;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('recaptcha_signup_url');?></span>
				<input type="text" class="form-control" name="signup_url" value="<?php echo $recaptcha_signup_url;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('recaptcha_theme');?></span>
				<input type="text" class="form-control" name="recaptcha_theme" value="<?php echo $recaptcha_theme;?>" />
			</div>

			<input class="btn btn-primary" type="submit" value="Submit" />

</fieldset>
<?php echo form_close();?>
</div>