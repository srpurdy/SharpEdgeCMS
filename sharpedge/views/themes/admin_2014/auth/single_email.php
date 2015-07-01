<div class="form-horizontal">
<p><?php echo $this->lang->line('mass_email_para');?></p>
    <?php echo form_open("/user_admin/single_user_email/" . $this->uri->segment(3));?>
		<fieldset>
	
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_subject');?></span>
				<input type="text" class="form-control" name="mass_subject" value="" />
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_message');?></span>
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: set_value('mass_message');
				echo form_ckeditor('mass_message', $textareaContent);?>
			</div>

			<?php echo form_submit(array('name'=>'submit',
					 'class' => 'btn btn-primary',  
					 'id'=>'submit', 
					 'value'=> 'Send'))?>

		</fieldset>
    <?php echo form_close();?>
</div>