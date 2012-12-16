<div class="form-horizontal">
	<div id="infoMessage"><?php echo $message;?></div>
	
    <?php echo form_open("/user_admin/create_user");?>
		<fieldset>
	
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_first_name');?></label>
				<div class="controls">
				<?php echo form_input($first_name);?>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_last_name');?></label>
				<div class="controls">
				<?php echo form_input($last_name);?>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_company_name');?></label>
				<div class="controls">
				<?php echo form_input($company);?>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_email_address');?></label>
				<div class="controls">
				<?php echo form_input($email);?>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_phone');?></label>
				<div class="controls">
				<?php echo form_input($phone1);?>-<?php echo form_input($phone2);?>-<?php echo form_input($phone3);?>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_password');?></label>
				<div class="controls">
				<?php echo form_input($password);?>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_confirm_password');?></label>
				<div class="controls">
				<?php echo form_input($password_confirm);?>
				</div>
			</div>

			<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit',
					 'class' => 'btn btn-primary',  
					 'id'=>'submit', 
					 'value'=> 'Create User'))?>
			</div>

		</fieldset>
    <?php echo form_close();?>
</div>