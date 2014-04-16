<?php $this->tables = $this->config->item('tables', 'ion_auth');?>
<?php $groups = $this->tables['groups'];?>
<?php $users = $this->tables['users'];?>
<?php $meta = $this->tables['meta'];?>
<?php $site_title = $this->config->item('site_title', 'ion_auth');?>
<?php $admin_email = $this->config->item('admin_email', 'ion_auth');?>
<?php $default_group = $this->config->item('default_group', 'ion_auth');?>
<?php $admin_group = $this->config->item('admin_group', 'ion_auth');?>
<?php $join = $this->config->item('join', 'ion_auth');?>
<?php $this->columns = $this->config->item('columns', 'ion_auth');?>
<?php $first_name = $this->columns[0];?>
<?php $last_name = $this->columns[1];?>
<?php $company = $this->columns[2];?>
<?php $phone = $this->columns[3];?>
<?php $identity = $this->config->item('identity', 'ion_auth');?>
<?php $min_password = $this->config->item('min_password_length', 'ion_auth');?>
<?php $max_password = $this->config->item('max_password_length', 'ion_auth');?>
<?php $email_activation = $this->config->item('email_activation', 'ion_auth');?>
<?php $remember_users = $this->config->item('remember_users', 'ion_auth');?>
<?php $user_expire = $this->config->item('user_expire', 'ion_auth');?>
<?php $extend_login = $this->config->item('user_extend_on_login', 'ion_auth');?>
<?php $email_templates = $this->config->item('email_templates', 'ion_auth');?>
<?php $email_activate = $this->config->item('email_activate', 'ion_auth');?>
<?php $email_forgot_password = $this->config->item('email_forgot_password', 'ion_auth');?>
<?php $email_forgot_password_complete = $this->config->item('email_forgot_password_complete', 'ion_auth');?>
<?php $salt_length = $this->config->item('salt_length', 'ion_auth');?>
<?php $store_salt = $this->config->item('store_salt', 'ion_auth');?>
<?php $message_start_delimiter = $this->config->item('message_start_delimiter', 'ion_auth');?>
<?php $message_end_delimiter = $this->config->item('message_end_delimiter', 'ion_auth');?>
<?php $error_start_delimiter = $this->config->item('error_start_delimiter', 'ion_auth');?>
<?php $error_end_delimiter = $this->config->item('error_end_delimiter', 'ion_auth');?>
<p>User/Login System Configuration</p>
<?php echo form_open('configuration/user_config/');?>
		<fieldset>
			<legend><?php echo $this->lang->line('user_config');?></legend>
            
			<?php echo form_error('groups');?>
			<label for="name">Groups</label>
			<input type="text" class="field" name="groups" value="<?php echo $groups;?>" /><br />
			
			<?php echo form_error('users');?>
			<label for="name">Users</label>
			<input type="text" class="field" name="users" value="<?php echo $users;?>" /><br />
			
			<?php echo form_error('meta');?>
			<label for="name">Meta</label>
			<input type="text" class="field" name="meta" value="<?php echo $meta;?>" /><br />
			
			<?php echo form_error('site_title');?>
			<label for="name">Site Title</label>
			<input type="text" class="field" name="site_title" value="<?php echo $site_title;?>" /><br />
			
			<?php echo form_error('admin_email');?>
			<label for="name">Admin Email</label>
			<input type="text" class="field" name="admin_email" value="<?php echo $admin_email;?>" /><br />
			
			<?php echo form_error('default_group');?>
			<label for="name">Default Group</label>
			<input type="text" class="field" name="default_group" value="<?php echo $default_group;?>" /><br />
			
			<?php echo form_error('admin_group');?>
			<label for="name">Admin Group</label>
			<input type="text" class="field" name="admin_group" value="<?php echo $admin_group;?>" /><br />
		
			<?php echo form_error('join');?>
			<label for="name">Join</label>
			<input type="text" class="field" name="join" value="<?php echo $join;?>" /><br />
			
			<?php echo form_error('first_name');?>
			<label for="name">Columns 1</label>
			<input type="text" class="field" name="first_name" value="<?php echo $first_name;?>" /><br />
			
			<?php echo form_error('last_name');?>
			<label for="name">Columns 2</label>
			<input type="text" class="field" name="last_name" value="<?php echo $last_name;?>" /><br />
			
			<?php echo form_error('company');?>
			<label for="name">Columns 3</label>
			<input type="text" class="field" name="company" value="<?php echo $company;?>" /><br />
			
			<?php echo form_error('phone');?>
			<label for="name">Columns 4</label>
			<input type="text" class="field" name="phone" value="<?php echo $phone;?>" /><br />
			
			<?php echo form_error('identity');?>
			<label for="name">Identity</label>
			<input type="text" class="field" name="identity" value="<?php echo $identity;?>" /><br />
			
			<?php echo form_error('min_password_length');?>
			<label for="name">Min Password Length</label>
			<input type="text" class="field" name="min_password_length" value="<?php echo $min_password;?>" /><br />
			
			<?php echo form_error('max_password_length');?>
			<label for="name">Max Password Length</label>
			<input type="text" class="field" name="max_password_length" value="<?php echo $max_password;?>" /><br />
			
			<label for="name">Email Activation</label>
			<select name="email_activation">
			<option value="true"<?php if($email_activation == 1):?>selected="selected"<?php endif;?>>true</option>
			<option value="false"<?php if($email_activation == 0):?>selected="selected"<?php endif;?>>false</option>
			</select><br />
				
			<label for="name">Remember Users</label>
			<select name="remember_users">
			<option value="true"<?php if($remember_users == 1):?>selected="selected"<?php endif;?>>true</option>
			<option value="false"<?php if($remember_users == 0):?>selected="selected"<?php endif;?>>false</option>
			</select><br />
			
			<?php echo form_error('user_expire');?>
			<label for="name">User Expire</label>
			<input type="text" class="field" name="user_expire" value="<?php echo $user_expire;?>" /><br />
			
			<label for="name">Extend Login</label>
			<select name="user_extend_on_login">
			<option value="true"<?php if($extend_login == 1):?>selected="selected"<?php endif;?>>true</option>
			<option value="false"<?php if($extend_login == 0):?>selected="selected"<?php endif;?>>false</option>
			</select><br />
			
			<?php echo form_error('email_templates');?>
			<label for="name">Email Templates</label>
			<input type="text" class="field" name="email_templates" value="<?php echo $email_templates;?>" /><br />
			
			<?php echo form_error('email_activate');?>
			<label for="name">Email Activate</label>
			<input type="text" class="field" name="email_activate" value="<?php echo $email_activate;?>" /><br />
			
			<?php echo form_error('email_forgot_password');?>
			<label for="name">Email Forgot Password</label>
			<input type="text" class="field" name="email_forgot_password" value="<?php echo $email_forgot_password;?>" /><br />
			
			<?php echo form_error('email_forgot_password_complete');?>
			<label for="name">Email Forgot Complete</label>
			<input type="text" class="field" name="email_forgot_password_complete" value="<?php echo $email_forgot_password_complete;?>" /><br />
			
			<?php echo form_error('salt_length');?>
			<label for="name">Salt Length</label>
			<input type="text" class="field" name="salt_length" value="<?php echo $salt_length;?>" /><br />
			
			<label for="name">Store Salt</label>
			<select name="store_salt">
			<option value="true"<?php if($store_salt == 1):?>selected="selected"<?php endif;?>>true</option>
			<option value="false"<?php if($store_salt == 0):?>selected="selected"<?php endif;?>>false</option>
			</select><br />
			
			<?php echo form_error('message_start_delimiter');?>
			<label for="name">Message Start</label>
			<input type="text" class="field" name="message_start_delimiter" value="<?php echo $message_start_delimiter;?>" /><br />
			
			<?php echo form_error('message_end_delimiter');?>
			<label for="name">Message End</label>
			<input type="text" class="field" name="message_end_delimiter" value="<?php echo $message_end_delimiter;?>" /><br />
			
			<?php echo form_error('error_start_delimiter');?>
			<label for="name">Error Start</label>
			<input type="text" class="field" name="error_start_delimiter" value="<?php echo $error_start_delimiter;?>" /><br />
			
			<?php echo form_error('error_end_delimiter');?>
			<label for="name">Error End</label>
			<input type="text" class="field" name="error_end_delimiter" value="<?php echo $error_end_delimiter;?>" /><br />
			
			<input class="submit" type="submit" value="Submit" />
</fieldset>
<?php echo form_close();?>