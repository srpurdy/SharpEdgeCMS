<div id="infoMessage"><?php echo $message;?></div>
<div class="form-horizontal">
<?php echo form_open("auth/change_password");?>
<div class='mainInfo'>
<fieldset>
	<legend>Change Password</legend>
	
		<div class="control-group">
		<label class="control-label"><?php echo $this->lang->line('label_old_password');?></label>
			<div class="controls">
			<?php echo form_input($old_password);?>
			</div>
		</div>

		<div class="control-group">
		<label class="control-label"><?php echo $this->lang->line('label_new_password');?></label>
			<div class="controls">
			<?php echo form_input($new_password);?>
			</div>
		</div>

		<div class="control-group">
		<label class="control-label"><?php echo $this->lang->line('label_confirm_new_password');?></label>
			<div class="controls">
			<?php echo form_input($new_password_confirm);?>
			</div>
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