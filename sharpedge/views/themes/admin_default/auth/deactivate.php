<div class='mainInfo'>
	<div class="pageTitle"><?php echo $this->lang->line('label_deactivate_user');?></div>
    <div class="pageTitleBorder"></div>
	<p><?php echo $this->lang->line('label_deactivate_paragraph');?> '<?php echo $user->username; ?>'</p>
	
    <?php echo form_open("/user_admin/deactivate/".$user->id);?>
		<fieldset>
		<input type="radio" name="confirm" value="yes" checked="checked" /><?php echo $this->lang->line('label_yes');?>
		<input type="radio" name="confirm" value="no" /><?php echo $this->lang->line('label_no');?>
      <?php echo form_hidden(array('id'=>$user->id)); ?>
      
            <p><?php echo form_submit(array('name'=>'submit',
						 'class' => 'submit',  
	                     'id'=>'submit', 
	                     'value'=> 'Submit'))?></p>
						 
	</fieldset>

    <?php echo form_close();?>

</div>
