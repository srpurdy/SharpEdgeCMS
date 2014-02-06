<div class="form-horizontal">
<p>If you wish to include images in your email. Be sure to make sure uploaded images contain the full URL Address of where those images are stored. Otherwise they will not display in the email.</p>
    <?php echo form_open("/user_admin/mass_email");?>
		<fieldset>
	
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_subject');?></label>
				<div class="controls">
				<input type="text" class="span10" name="mass_subject" value="" />
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_message');?></label>
				<div class="controls">
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: set_value('mass_message');
				echo form_ckeditor('mass_message', $textareaContent);?>
				</div>
			</div>

			<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit',
					 'class' => 'btn btn-primary',  
					 'id'=>'submit', 
					 'value'=> 'Send'))?>
			</div>

		</fieldset>
    <?php echo form_close();?>
</div>