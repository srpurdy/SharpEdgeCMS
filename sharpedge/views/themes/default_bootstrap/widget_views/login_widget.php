<?php $logged_in = $this->ion_auth->logged_in();?>
<?php if($logged_in == false):?>
<?php 
$identity = array('name' => 'identity',
	'id' => 'identity',
	'class' => 'form-control',
	'type' => 'text',
	'value' => $this->form_validation->set_value('identity'),
);
$password = array('name' => 'password',
	'id' => 'password',
	'class' => 'form-control',
	'type' => 'password',
);

$remember = array(
	'name' => 'remember',
	'class' => 'form-control',
	'value' => '1'
	);
?>
<div class='mainInfo remove_underline' style="padding:5px;">
	<div class="pageTitleBorder"></div>
	<div id="infoMessage"><?php echo $message;?></div>

	<?php echo form_open("auth/login");?>
	<fieldset id="login">	
	<input name="prev_uri" type="hidden" value="<?php echo $this->uri->uri_string();?>" />
	<div class="input-group"> 
	<span class="input-group-addon"><?php echo $this->lang->line('label_login_username');?></span>
		<?php echo form_input($identity);?>
	</div>

	<div class="input-group"> 
	<span class="input-group-addon"><?php echo $this->lang->line('label_password');?></span>
		<?php echo form_input($password);?>
	</div>

	<div class="input-group"> 
	<span class="input-group-addon"><?php echo $this->lang->line('label_remember_me');?></span>
		<?php echo form_checkbox($remember);?>
	</div>
	  
	<br />
	<div class="form-actions">
	<a style="float:right;" href="<?php echo site_url();?>/auth/facebook"><img width="123" height="27" src="<?php echo base_url();?>themes/default_bootstrap/img/facebookConnectButton.png" /></a><br />
	<?php echo form_submit(array('name'=>'submit',
						 'class' => 'btn btn-primary',  
	                     'id'=>'submit', 
	                     'value'=> 'Login'))?>
	<div class="clearfix"></div>
	<br />
	<a class="btn btn-success" href="<?php echo site_url();?>/auth/create_user"><?php echo $this->lang->line('label_register');?></a>
	<a class="btn btn-danger" href="<?php echo site_url();?>/auth/forgot_password"><?php echo $this->lang->line('label_forgot_password');?></a>
	</div>
	</fieldset>
	<?php echo form_close();?>
</div>
<?php else:?>
<?php foreach($current_profile as $cp):?>

<img src="<?php echo base_url();?><?php echo $this->config->item('ava_upload_directory');?>/<?php echo $cp->avatar?>" alt="Current Image" /><br />

<small>
<?php echo $this->lang->line('label_name');?>: <?php echo $this->session->userdata('first_name');?> <?php echo $this->session->userdata('last_name');?><br />
<?php echo $this->lang->line('label_total_posts');?>: <?php echo $cp->total_posts;?><br />
<?php echo $this->lang->line('label_location');?>: <?php echo $cp->location;?><br />
<?php echo $this->lang->line('label_website');?>: <?php echo $cp->website;?><br />
<a class="btn btn-default" href="<?php echo site_url();?>/auth/edit_profile"><?php echo $this->lang->line('label_edit');?></a>
<a class="btn btn-default" href="#"><?php echo $this->lang->line('label_view_profile');?></a>
</small>
<?php endforeach;?>
<?php endif;?>
