<?php
$email = array('name' => 'email',
	'class' => 'form-control',
	'id' => 'email',
);
?>
<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/forgot_password");?>
<fieldset>
<div class="alert alert-info"><?php echo $this->lang->line('label_forgot_paragraph');?></div>

	<div class="input-group">
	<span class="input-group-addon"><?php echo $this->lang->line('label_email_address');?></span>
		<?php echo form_input($email);?>
	</div>

	<br />
	<?php echo form_submit(array('name'=>'submit',
				 'class' => 'btn btn-primary',  
				 'id'=>'submit', 
				 'value'=> 'Send'))?>
</fieldset>      
<?php echo form_close();?>