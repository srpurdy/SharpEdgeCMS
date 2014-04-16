	<p><?php echo $this->lang->line('label_deactivate_paragraph');?> '<?php echo $user->username; ?>'</p>
	
    <?php echo form_open("/user_admin/deactivate/".$user->id);?>
		<fieldset>
		
		<div class="input-group">
			<span class="input-group-addon">
			<input type="radio" name="confirm" value="yes" checked="checked" /><?php echo $this->lang->line('label_yes');?>
			<input type="radio" name="confirm" value="no" /><?php echo $this->lang->line('label_no');?>
			</span>
		</div>
		
      <?php echo form_hidden(array('id'=>$user->id)); ?>
      
<?php echo form_submit(array('name'=>'submit',
						 'class' => 'btn btn-danger',  
	                     'id'=>'submit', 
	                     'value'=> 'Submit'))?>
						 
	</fieldset>

    <?php echo form_close();?>
