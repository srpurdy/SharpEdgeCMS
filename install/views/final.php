		<div class="clearfix"></div><br />
		<div class="progress progress-info">
		<div class="bar" style="width: 75%"></div>
		</div>
		
		<h3>Final Step!</h3>
		<p>We're almost there! Please enter default user information below for your SharpEdge admin account, the name of your database. (you may have to manually create it depending on your server configuration.)</p>
		<div class="form-horizontal">
		<?php echo form_open('install/user_info'); ?>
			<fieldset>
				<legend>Database Settings</legend>
				
				<div class="control-group">
				<label class="control-label">Database Name</label>
					<div class="controls">
					<input type="text" id="database" class="field" name="database" value="<?php echo set_value('database'); ?>" />
					</div>
				</div>

				<div class="control-group">
				<label class="control-label">Create Database</label>
					<div class="controls">
					<input type="checkbox" name="create_db" value="true" id="create_db" />
					<small>(You might need to do this manually!)</small>
					</div>
				</div>

				<legend>Default User Account</legend>
				
				<div class="control-group">
				<label class="control-label">User Name</label>
					<div class="controls">
					<?php
						echo form_input(array(
							'class' => 'field', 
							'id' => 'user_name',
							'name' => 'user_name',
							'value' => set_value('user_name')
						));
					?>
					</div>
				</div>

				<div class="control-group">
				<label class="control-label">First Name</label>
					<div class="controls">
					<?php
						echo form_input(array(
							'class' => 'field', 
							'id' => 'user_firstname',
							'name' => 'user_firstname',
							'value' => set_value('user_firstname')
						));
					?>
					</div>
				</div>

				<div class="control-group">
				<label class="control-label">Last Name</label>
					<div class="controls">
					<?php
						echo form_input(array(
							'class' => 'field', 
							'id' => 'user_lastname',
							'name' => 'user_lastname',
							'value' => set_value('user_lastname')
						));
					?>
					</div>
				</div>

				<div class="control-group">
				<label class="control-label">Email</label>
					<div class="controls">
					<?php
						echo form_input(array(
							'class' => 'field', 
							'id' => 'user_email',
							'name' => 'user_email',
							'value' => set_value('user_email')
						));
					?>
					</div>
				</div>

				<div class="control-group">
				<label class="control-label">Password</label>
					<div class="controls">
					<?php
						echo form_password(array(
							'class' => 'field', 
							'id' => 'user_password',
							'name' => 'user_password',
							'value' => set_value('user_password')
						));
					?>
					</div>
				</div>

				<div class="control-group">
				<label class="control-label">Confirm Password</label>
					<div class="controls">
					<?php
						echo form_password(array(
							'class' => 'field', 
							'id' => 'user_confirm_password',
							'name' => 'user_confirm_password',
							'value' => set_value('user_confirm_password')
						));
					?>
					</div>
				</div>
					
				<input class="btn btn-primary" id="next_step" type="submit" value="Finish!" />
			</fieldset>
		<?php echo form_close(); ?>
		</div>