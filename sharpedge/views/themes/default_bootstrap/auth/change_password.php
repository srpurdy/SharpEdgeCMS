<div id="infoMessage"><?php echo $message;?></div>
<div class="form-horizontal">
<?php echo form_open("auth/change_password");?>
<div class='mainInfo'>
<?php
$old_password = array(
		'name' => 'old',
		'class' => 'form-control',
		'id'   => 'old',
		'type' => 'password',
);

$new_password = array(
		'name' => 'new',
		'class' => 'form-control',
		'id'   => 'new',
		'type' => 'password',
);

$new_password_confirm = array(
		'name' => 'new_confirm',
		'class' => 'form-control',
		'id'   => 'new_confirm',
		'type' => 'password',
);
?>
<fieldset>
	<legend>Change Password</legend>
	
		<div class="input-group">
		<span class="input-group-addon"><?php echo $this->lang->line('label_old_password');?></span>
			<?php echo form_input($old_password);?>
		</div>

		<div class="input-group">
		<span class="input-group-addon"><?php echo $this->lang->line('label_new_password');?></span>
			<?php echo form_input($new_password);?>
		</div>

		<div class="input-group">
		<span class="input-group-addon"><?php echo $this->lang->line('label_confirm_new_password');?></span>
			<?php echo form_input($new_password_confirm);?>
		</div>

		<?php echo form_input($user_id);?>
		
		<div class="form-actions">
				<?php echo form_submit(array('name'=>'submit',
						 'class' => 'btn btn-primary',  
						 'id'=>'submit', 
						 'value'=> 'Change'))?>
		</div>
		
</fieldset>
</div>
<?php echo form_close();?>
</div>