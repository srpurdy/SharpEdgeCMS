<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/change_password");?>
<div class='mainInfo'>
<fieldset>
      <label><?php echo $this->lang->line('label_old_password');?></label>
      <?php echo form_input($old_password);?><br /><br />
      
      <label><?php echo $this->lang->line('label_new_password');?></label>
      <?php echo form_input($new_password);?><br /><br />
      
      <label><?php echo $this->lang->line('label_confirm_new_password');?></label>
      <?php echo form_input($new_password_confirm);?><br /><br />
      
      <?php echo form_input($user_id);?>
	  <?php echo form_submit(array('name'=>'submit',
						 'class' => 'submit',  
	                     'id'=>'submit', 
	                     'value'=> 'Change'))?>
</fieldset>
</div>
<?php echo form_close();?>