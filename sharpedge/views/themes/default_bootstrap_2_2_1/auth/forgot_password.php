<p><?php echo $this->lang->line('label_forgot_paragraph');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/forgot_password");?>
<fieldset>
      <label><?php echo $this->lang->line('label_email_address');?></label>
      <?php echo form_input($email);?><br />
      
      <?php echo form_submit(array('name'=>'submit',
						 'class' => 'btn',  
	                     'id'=>'submit', 
	                     'value'=> 'Submit'))?>
</fieldset>      
<?php echo form_close();?>