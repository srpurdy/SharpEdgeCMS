	<div class="clearfix"></div><br />
	<div class="progress progress-info">
	<div class="bar" style="width: 25%"></div>
	</div>
	<h3>Database Information</h3>
	<p>Please enter your database username, password, hostname and port number below. The installation script will test your database connection before proceeding.</p>
	
	<div id="notification">
	<p class="text" id="confirm_db"></p>
	</div>
	
	<div class="form-horizontal">
	<?php echo form_open('install/database_information');?>
		<fieldset>
			<legend>Database Information</legend>
			
			
			<div class="control-group">
			<label class="control-label">Hostname</label>
				<div class="controls">
				<?php echo form_input(array('class' => 'field', 'id' => 'hostname','name' => 'hostname','value' => set_value('hostname')));?>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label">Username</label>
				<div class="controls">
				<?php echo form_input(array('class' => 'field', 'id' => 'username','name' => 'username','value' => set_value('username')));?>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label">Password</label>
				<div class="controls">
				<?php echo form_input(array('class' => 'field', 'id' => 'password','name' => 'password','value' => set_value('password')));?>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label">Port</label>
				<div class="controls">
				<?php echo form_input(array('class' => 'field', 'id' => 'port','name' => 'port','value' => set_value('port')));?>
				</div>
			</div>

			<div class="form-actions">
			<input class="btn btn-primary" id="next_step" type="submit" value="Check Software (Step 2)" />
			</div>
			
		</fieldset>
	<?php echo form_close();?>
	</div>