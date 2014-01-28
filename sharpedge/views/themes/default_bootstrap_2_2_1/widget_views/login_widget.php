<?php $logged_in = $this->ion_auth->logged_in();?>
<?php if($logged_in == false):?>
<div class='mainInfo remove_underline' style="padding:5px;">
	<div class="pageTitleBorder"></div>
	<div id="infoMessage"><?php echo $message;?></div>

	<?php echo form_open("auth/login");?>
	<fieldset id="login">	
	<input name="prev_uri" type="hidden" value="<?php echo $this->uri->uri_string();?>" />
	<div class="control-group"> 
	<label class="control-label" for="identity">Email:</label>
		<div class="controls"> 
		<?php echo form_input($identity);?>
		</div>
	</div>

	<div class="control-group"> 
	<label class="control-label" for="password">Password:</label>
		<div class="controls"> 
		<?php echo form_input($password);?>
		</div>
	</div>

	<div class="control-group"> 
	<label class="control-label">Remember:</label>
		<div class="controls"> 
		<?php echo form_checkbox('remember', '1', FALSE);?>
		</div>
	</div>
	  
	<div class="form-actions">
	<a style="float:right;" href="<?php echo site_url();?>/auth/facebook"><img width="123" height="27" src="<?php echo base_url();?>themes/default_bootstrap/img/facebookConnectButton.png" /></a><br />
	<?php echo form_submit(array('name'=>'submit',
						 'class' => 'btn btn-primary',  
	                     'id'=>'submit', 
	                     'value'=> 'Login'))?>
	</div>

	</fieldset>
	<a class="btn btn-success" href="<?php echo site_url();?>/auth/create_user">Register</a>
	<a class="btn btn-danger" href="<?php echo site_url();?>/auth/forgot_password">Forgot Password</a><br />
	<?php echo form_close();?>
</div>
<?php else:?>
<?php foreach($current_profile as $cp):?>

<img src="<?php echo base_url();?><?php echo $this->config->item('ava_upload_directory');?>/<?php echo $cp->avatar?>" alt="Current Image" /><br />

<small>
Name: <?php echo $this->session->userdata('first_name');?> <?php echo $this->session->userdata('last_name');?><br />
Total Posts: <?php echo $cp->total_posts;?><br />
Location: <?php echo $cp->location;?><br />
Website: <?php echo $cp->website;?><br />
<a class="btn" href="<?php echo site_url();?>/auth/edit_profile">Edit</a>
<a class="btn" href="#">View Profile</a>
</small>
<?php endforeach;?>
<?php endif;?>
