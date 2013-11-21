<div class='mainInfo remove_underline' style="padding:5px;">
	<div class="pageTitleBorder"></div>
	<div id="infoMessage"><?php echo $message;?></div>

	<?php echo form_open("auth/login");?>
	<fieldset id="login">	
	<input name="prev_uri" type="hidden" value="<?php echo $this->uri->uri_string();?>" />
	<div class="control-group">
	<label class="control-label" for="identity"><?php echo $this->lang->line('label_login_username');?></label>
		<div class="controls">
		<?php echo form_input($identity);?>
		</div>
	</div>

	<div class="control-group">
	<label class="control-label" for="password"><?php echo $this->lang->line('label_password');?></label>
		<div class="controls">
		<?php echo form_input($password);?>
		</div>
	</div>

	<div class="control-group">
	<label class="control-label" for="remember"><?php echo $this->lang->line('label_remember_me');?></label>
		<div class="controls">
		<?php echo form_checkbox('remember', '1', FALSE);?>
		</div>
	</div>
	  
	<div class="form-actions">
	<?php echo form_submit(array('name'=>'submit',
						 'class' => 'btn btn-primary',  
	                     'id'=>'submit', 
	                     'value'=> 'Login'))?>
	<a class="btn btn-success" href="<?php echo site_url();?>/auth/create_user"><?php echo $this->lang->line('label_register');?></a>
	<a class="btn btn-danger" href="<?php echo site_url();?>/auth/forgot_password"><?php echo $this->lang->line('label_forgot_password');?></a>
	</div>

	</fieldset>
	<?php echo form_close();?>
</div>