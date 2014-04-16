<?php foreach($users->result() as $id):?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_user');?></legend>
		
		<?php echo form_open("user_admin/edit_user/".$this->uri->segment(3));?>

		<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_email_address');?></span>
			<input type="text" class="form-control" name="email" value="<?php echo $id->email?>" />
		</div>

		<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_first_name');?></span>
			<input type="text" class="form-control" name="first_name" value="<?php echo $id->first_name?>" />
		</div>

		<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_last_name');?></span>
			<input type="text" class="form-control" name="last_name" value="<?php echo $id->last_name?>" />
		</div>

		<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_company_name');?></span>
			<input type="text" class="form-control" name="company" value="<?php echo $id->company?>" />
		</div>

		<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_phone');?></span>
			<input type="text" class="form-control" name="phone" value="<?php echo $id->phone?>" />
		</div>

		<?php echo form_submit('submit', 'Submit', 'class="btn btn-primary"');?>

	</fieldset>
    <?php echo form_close();?>

<?php endforeach;?>