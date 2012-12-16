<div class="form-horizontal">
<?php echo $error?>
<?php echo form_open_multipart('upload/do_upload'); ?>
	<fieldset>
	
		<legend></legend>
	
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_select_file');?></label>
				<div class="controls">
				<input type="file" name="userfile" size="20" class="field" value="" />
				</div>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
	
	</fieldset>
<?php echo form_close();?>
</div>