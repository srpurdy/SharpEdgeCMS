<script type="text/javascript">
    $('#profile_tabs a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
    })
</script>
<ul class="nav nav-tabs remove_underline" id="profile_tabs">
<li><a href="#home" data-toggle="tab"><?php echo $this->lang->line('module_dashboard');?></a></li>
<li><a href="#changepassword" data-toggle="tab"><?php echo $this->lang->line('label_change_password');?></a></li>
<li><a href="#profile" data-toggle="tab"><?php echo $this->lang->line('label_profile');?></a></li>
<li><a href="#forumpreferences" data-toggle="tab"><?php echo $this->lang->line('label_preferences');?></a></li>
<li><a href="#settings" data-toggle="tab"><?php echo $this->lang->line('label_admin_menu_settings');?></a></li>
<li><a href="#extra_fields" data-toggle="tab"><?php echo $this->lang->line('label_extra_fields');?></a></li>
</ul>

<div class="tab-content">
<div class="tab-pane active" id="home">
<?php foreach($users->result() as $id):?>
<div class='mainInfo'>
<div class="form-horizontal">
	<?php echo form_open("auth/edit_profile");?>
	<fieldset>
	<legend><?php echo $this->lang->line('module_dashboard');?></legend>
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

		<?php if($this->config->item('company_enabled') == 'Y'):?>
		<div class="input-group">
		<span class="input-group-addon"><?php echo $this->lang->line('label_company_name');?></span>
			<input type="text" class="form-control" name="company" value="<?php echo $id->company?>" />
		</div>
		<?php endif;?>

		<?php if($this->config->item('phone_enabled') == 'Y'):?>
		<div class="input-group">
		<span class="input-group-addon"><?php echo $this->lang->line('label_phone');?></span>
			<input type="text" class="form-control" name="phone" value="<?php echo $id->phone?>" />
		</div>
		<?php endif;?>

		<div class="form-actions">
		<?php echo form_submit('submit', 'Submit', 'class="btn btn-primary"');?>
		</div>
	<?php echo form_close();?>
	</fieldset>
</div>
</div>
<?php endforeach;?>
</div>

<div class="tab-pane" id="changepassword">
<?php echo modules::run('users/auth/change_password');?>
</div>

<div class="tab-pane" id="profile">
<?php echo modules::run('profile/edit_profile');?>
</div>

<div class="tab-pane" id="forumpreferences">
<?php echo modules::run('profile/edit_preferences');?>
</div>

<div class="tab-pane" id="settings">
<?php echo modules::run('profile/edit_settings');?>
</div>

<div class="tab-pane" id="extra_fields">
<?php echo modules::run('profile/custom_fields');?>
</div>

</div>