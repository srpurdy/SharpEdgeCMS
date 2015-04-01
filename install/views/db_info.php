	<div class="clearfix"></div><br />
	<div class="progress">
		<div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
			<span class="sr-only">25% Complete</span>
		</div>
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
			
			
			<div class="input-group">
				<span class="input-group-addon">Hostname</span>
				<?php echo form_input(array('class' => 'form-control', 'id' => 'hostname','name' => 'hostname','value' => set_value('hostname')));?>
			</div>

			<div class="input-group">
				<span class="input-group-addon">Username</span>
				<?php echo form_input(array('class' => 'form-control', 'id' => 'username','name' => 'username','value' => set_value('username')));?>
			</div>

			<div class="input-group">
				<span class="input-group-addon">Password</span>
				<?php echo form_input(array('class' => 'form-control', 'id' => 'password','name' => 'password','value' => set_value('password')));?>
			</div>

			<div class="input-group">
				<span class="input-group-addon">Port</span>
				<?php echo form_input(array('class' => 'form-control', 'id' => 'port','name' => 'port','value' => '3306'));?>
			</div>

			<input class="btn btn-primary" id="next_step" type="submit" value="Check Software (Step 2)" />
			
		</fieldset>
	<?php echo form_close();?>
	</div>