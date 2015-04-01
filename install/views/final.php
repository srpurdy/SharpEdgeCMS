		<div class="clearfix"></div><br />
		<div class="progress">
		<div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
			<span class="sr-only">75% Complete</span>
		</div>
	</div>
		
		<h3>Final Step!</h3>
		<p>We're almost there! Please enter default user information below for your SharpEdge admin account, the name of your database. (you may have to manually create it depending on your server configuration.)</p>
		<div class="form-horizontal">
		<?php echo form_open('install/user_info'); ?>
			<fieldset>
				<legend>Database Settings</legend>
				
				<div class="input-group">
				<span class="input-group-addon">Database Name</span>
					<input type="text" id="database" class="form-control" name="database" value="<?php echo set_value('database'); ?>" />
				</div>

				<div class="input-group">
				<span class="input-group-addon">Create Database</span>
					<input type="checkbox" name="create_db" value="true" id="create_db" />
					<small>(You might need to do this manually!)</small>
				</div>

				<legend>Default User Account</legend>
				
				<div class="input-group">
				<span class="input-group-addon">User Name</span>
					<?php
						echo form_input(array(
							'class' => 'form-control', 
							'id' => 'user_name',
							'name' => 'user_name',
							'value' => set_value('user_name')
						));
					?>
				</div>

				<div class="input-group">
				<span class="input-group-addon">First Name</span>
					<?php
						echo form_input(array(
							'class' => 'form-control', 
							'id' => 'user_firstname',
							'name' => 'user_firstname',
							'value' => set_value('user_firstname')
						));
					?>
				</div>

				<div class="input-group">
				<span class="input-group-addon">Last Name</span>
					<?php
						echo form_input(array(
							'class' => 'form-control', 
							'id' => 'user_lastname',
							'name' => 'user_lastname',
							'value' => set_value('user_lastname')
						));
					?>
				</div>

				<div class="input-group">
				<span class="input-group-addon">Email</span>
					<?php
						echo form_input(array(
							'class' => 'form-control', 
							'id' => 'user_email',
							'name' => 'user_email',
							'value' => set_value('user_email')
						));
					?>
				</div>

				<div class="input-group">
				<span class="input-group-addon">Password</span>
					<?php
						echo form_password(array(
							'class' => 'form-control', 
							'id' => 'user_password',
							'name' => 'user_password',
							'value' => set_value('user_password')
						));
					?>
				</div>

				<div class="input-group">
				<span class="input-group-addon">Confirm Password</span>
					<?php
						echo form_password(array(
							'class' => 'form-control', 
							'id' => 'user_confirm_password',
							'name' => 'user_confirm_password',
							'value' => set_value('user_confirm_password')
						));
					?>
				</div>
					
				<input class="btn btn-primary" id="next_step" type="submit" value="Finish!" />
			</fieldset>
		<?php echo form_close(); ?>
		</div>