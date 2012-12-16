<?php foreach($users->result() as $id):?>
<div class='mainInfo'>
<fieldset>
	<legend><?php echo $this->lang->line('label_edit_user');?></legend>
	
      <?php echo form_open("user_admin/edit_user/".$this->uri->segment(3));?>
      
      <label><?php echo $this->lang->line('label_email_address');?></label>
      <input type="text" class="field" name="email" value="<?php echo $id->email?>" /><br />
	  
	  <label><?php echo $this->lang->line('label_first_name');?></label>
      <input type="text" class="field" name="first_name" value="<?php echo $id->first_name?>" /><br />
	  
	  <label><?php echo $this->lang->line('label_last_name');?></label>
      <input type="text" class="field" name="last_name" value="<?php echo $id->last_name?>" /><br />
	  
	  <label><?php echo $this->lang->line('label_company_name');?></label>
      <input type="text" class="field" name="company" value="<?php echo $id->company?>" /><br />
	  
	  <label><?php echo $this->lang->line('label_phone');?></label>
      <input type="text" class="field" name="phone" value="<?php echo $id->phone?>" /><br />
      
      <p><?php echo form_submit('submit', 'Submit', 'class="submit"');?></p>

</fieldset>
    <?php echo form_close();?>

</div>
<?php endforeach;?>